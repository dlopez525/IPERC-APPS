<?php

namespace App\Http\Controllers;

use App\Area;
use App\Risk;
use App\Zone;
use App\Iperc;
use App\Danger;
use App\FileLog;
use App\IpercFile;
use App\Consequence;
use App\Headquarter;
use App\JobPosition;
use App\DangerDescription;
use App\Exports\IpercExport;
use App\Imports\IpercImport;
use Illuminate\Http\Request;
use App\Imports\HeaderIpercImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class IPERCController extends Controller
{
    public $headquarter;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->headquarter = session()->has('headlocal') == true ? session()->get('headlocal') : auth()->user()->headquarter_id;
            return $next($request);
        });
    }

    public function index()
    {
        $jobPositions = JobPosition::where('headquarter_id', $this->headquarter)->get(['name', 'id']);

        return view('iperc.index', compact('jobPositions'));
    }

    public function dt_iperc(Request $request)
    {
        $iperc = Iperc::with(['task' => function ($query) {
                            $query->select('id', 'name');
                        }, 'danger' => function ($query) {
                            $query->select('id', 'name');
                        }, 'dangerDescription' => function ($query) {
                            $query->select('id', 'name','event','danger_id');
                        },'risk' => function ($query) {
                            $query->select('id', 'name');
                        }])
                        ->where('task_id', $request->task)
                        ->get();

        return datatables()->of($iperc)->toJson();
    }

    public function import()
    {
        DB::beginTransaction();
        try {
            $rawFile = request()->file('file');

            $existFile = IpercFile::where('name', $rawFile->getClientOriginalName())->where('headquarter_id', $this->headquarter)->first();

            if ($existFile != null) {
                return redirect()->back()->with('warning', 'El archivo ya existe.');
            }

            $file = new IpercFile;
            $file->name = $rawFile->getClientOriginalName();
            $file->headquarter_id = $this->headquarter;
            $file->user_id = auth()->user()->id;
            $file->save();

            $headerImport = Excel::import(new HeaderIpercImport($file->id), $rawFile);

            $import = Excel::import(new IpercImport($file->id), $rawFile);
            
            DB::commit();
            return redirect()->back()->with('info', 'Se importó correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            $message = "Ocurrió un error. No se completó el proceso de importación.<br> <b>Posibles errores</b> <ul><li>No Tiene una Sede asignada.</li><li>Se encontraron CELDAS VACIAS</li></ul> Corrija ello, e intente nuevamente";
            return back()->with('error', $message);
        }
    }

    public function create()
    {
        // $areas = Area::where('headquarter_id', $this->headquarter)->get(['name', 'id']);
        // $jobPositions = JobPosition::where('headquarter_id', $this->headquarter)->get(['name', 'id']);
        $dangers = Danger::where('headquarter_id', $this->headquarter)->orderBy('name','asc')->pluck('name', 'id');
        $headquarters = Headquarter::get(['id','name']);
        $descriptions = [];
        $events = [];
        $consequences = [];

        return view('iperc.create', compact('headquarters','dangers','descriptions', 'events', 'consequences'));
    }

    public function getJobPosition($file)
    {
        $jobPositions = JobPosition::where('headquarter_id', $this->headquarter)->where('iperc_file_id', $file)->get(['name', 'id']);

        return response()->json($jobPositions);
    }

    public function getArea($job)
    {
        $areas = Area::where('job_position_id', $job)->get(['id','name']);
        return response()->json($areas);
    }

    public function getZonas($area)
    {
        $zones = Zone::where('area_id', $area)->get(['id','name']);
        return response()->json($zones);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_job' => 'required',
            'consequence_evaluation' => 'required',
            'exhibition_evaluation' => 'required',
            'probability_evaluation' => 'required',
            'total_evaluation' => 'required',
            'task' => 'required',
            'danger_id' => 'required',
            'danger_description_id' => 'required',
            'consequence_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $total_evaluation = $request->total_evaluation;
        
            $risk = '';
            if ($total_evaluation >= 400) {
                $riskf = Risk::where('min', 400)->select('id')->first();
                $risk = $riskf->id;
            } else {
                $risks = Risk::all();

                foreach ($risks as $r) {
                    if ($total_evaluation >= $r->min && $total_evaluation <= $r->max) {
                        $risk = $r->id;
                    }
                }
            }
            
            $iperc = new Iperc;
            $iperc->type_job = $request->type_job;
            $iperc->consequence_evaluation = $request->consequence_evaluation;
            $iperc->exhibition_evaluation = $request->exhibition_evaluation;
            $iperc->probability_evaluation = $request->probability_evaluation;
            $iperc->total_evaluation = $total_evaluation;
            $iperc->engineering_controls = $request->engineering_controls;
            $iperc->administrative_controls = $request->administrative_controls;
            $iperc->epps = $request->epps;
            $iperc->task_id = $request->task;
            $iperc->danger_id = $request->danger_id;
            $iperc->danger_description_id = $request->danger_description_id;
            $iperc->consequence_id = $request->consequence_id;
            $iperc->risk_id = $risk;
            $iperc->user_id = auth()->user()->id;
            $iperc->iperc_file_id = $request->file;
            $iperc->save();

            $file = IpercFile::find($request->file);
            $file->last_update = date('Y-m-d');
            $file->save();
            
            DB::commit();
            return redirect()->route('iperc.index')->with('info', 'Se Guardó correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error.')->withInput();
        }
    }

    public function edit($id)
    {
        $dangers = Danger::where('headquarter_id', $this->headquarter)->pluck('name', 'id');
        $iperc = Iperc::find($id);
        $descriptions = DangerDescription::where('danger_id', $iperc->danger_id)->orderBy('name', 'asc')->pluck('name','id');
        $events = DangerDescription::where('id', $iperc->danger_description_id)->orderBy('event', 'asc')->pluck('event','id');
        $consequences = Consequence::where('danger_description_id', $iperc->danger_description_id)->orderBy('name', 'asc')->pluck('name','id');

        return view('iperc.edit', compact('iperc','dangers','descriptions', 'events', 'consequences'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type_job' => 'required',
            'consequence_evaluation' => 'required',
            'exhibition_evaluation' => 'required',
            'probability_evaluation' => 'required',
            'total_evaluation' => 'required',
            'danger_id' => 'required',
            'danger_description_id' => 'required',
            'consequence_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $total_evaluation = $request->total_evaluation;
        
            $risk = '';
            if ($total_evaluation >= 400) {
                $riskf = Risk::where('min', 400)->select('id')->first();
                $risk = $riskf->id;
            } else {
                $risks = Risk::all();

                foreach ($risks as $r) {
                    if ($total_evaluation >= $r->min && $total_evaluation <= $r->max) {
                        $risk = $r->id;
                    }
                }
            }
            
            $iperc = Iperc::find($id);
            $iperc->type_job = $request->type_job;
            $iperc->consequence_evaluation = $request->consequence_evaluation;
            $iperc->exhibition_evaluation = $request->exhibition_evaluation;
            $iperc->probability_evaluation = $request->probability_evaluation;
            $iperc->total_evaluation = $total_evaluation;
            $iperc->engineering_controls = $request->engineering_controls;
            $iperc->administrative_controls = $request->administrative_controls;
            $iperc->epps = $request->epps;
            $iperc->danger_id = $request->danger_id;
            $iperc->danger_description_id = $request->danger_description_id;
            $iperc->consequence_id = $request->consequence_id;
            $iperc->risk_id = $risk;
            $iperc->user_id = auth()->user()->id;
            $iperc->save();

            $file = IpercFile::find($iperc->iperc_file_id);
            $file->last_update = date('Y-m-d');
            $file->save();
            
            DB::commit();
            return redirect()->route('iperc.index')->with('info', 'Se Actualizó correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error.')->withInput();
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
           
            $el = Iperc::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e);
        }
    }

    public function dt_files()
    {
        $files = IpercFile::with('user:id,sap')->where('headquarter_id', $this->headquarter)->get(['user_id','name','created_at','id']);

        return datatables()->of($files)->toJson();
    }

    public function files()
    {
        return view('iperc.files');
    }

    public function getFiles(Request $request)
    {
        $page = $request->page;
        $resultCount = 15;

        $offset = ($page - 1) * $resultCount;
        $files = IpercFile::skip($offset)
                            ->where(function ($query) use ($request) {
                                if($request->search != null) {
                                    $query->where('name', 'like', '%'.$request->search.'%');
                                }
                            })
                            ->take($resultCount)
                            ->selectRaw('id, name as text')
                            ->get();

        $count = Count(IpercFile::where(function ($query) use ($request) {
                                    if($request->search != null) {
                                        $query->where('name', 'like', '%'.$request->search.'%');
                                    }
                                })
                                ->selectRaw('id, name as text')
                                ->get()
                    );

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $results = array(
            "results" => $files,
            "pagination" => array(
                "more" => $morePages
            )
        );

    	return response()->json($results);
    }

    public function deleteFiles(Request $request)
    {
        DB::beginTransaction();
        try {
           
            $el = IpercFile::find($request->el);
            
            $log = new FileLog;
            $log->file = $el->name;
            $log->name = auth()->user()->sap;
            $log->headquarter_id = $this->headquarter;
            $log->save();

            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e);
        }
    }

    public function export(Request $request)
    {
        $file = IpercFile::select('name')->find($request->file);

        return Excel::download(new IpercExport($request->file), $file->name);
    }

    public function fileLogIndex()
    {
        return view('iperc.logs');
    }

    public function dtFileLog()
    {
        $files = FileLog::where('headquarter_id', $this->headquarter)->get(['file','name','created_at']);

        return datatables()->of($files)->toJson();
    }
}
