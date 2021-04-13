<?php

namespace App\Http\Controllers;

use App\SubProcess;
use App\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobPositionController extends Controller
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
        // $subprocess = SubProcess::with('zone.area')->whereHas('zone.area', function ($query)
        // {
        //     return $query->where('headquarter_id', $this->headquarter);
        // })->get();

        // return view('general.job-position.index', compact('subprocess'));
        return view('general.job-position.index');
    }

    public function dt()
    {
        // $data = JobPosition::with('subProcess', 'subProcess.zone.area')->whereHas('subProcess.zone.area', function ($query)
        // {
        //     return $query->where('headquarter_id', $this->headquarter);
        // })->get();
        $data = JobPosition::with('file:id,name')->where('headquarter_id', $this->headquarter);

        return datatables()->of($data)->toJson();
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->el_id != null || $request->el_id != '') {
                $el = JobPosition::find($request->el_id);
            } else {
                $el = new JobPosition;
                $el->headquarter_id = $this->headquarter;
            }

            $el->name = $request->name;
            $el->iperc_file_id = $request->iperc_file;
            $el->save();
            
            DB::commit();
            return redirect()->back()->with('info', 'Se Guardó correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ooops. Hubo un problema, intentelo nuevamente.');
        }
    }

    public function get(Request $request)
    {
        $el = JobPosition::select(['name', 'iperc_file_id','id'])->find($request->el_id);

        return response()->json($el);
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $el = JobPosition::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }
}
