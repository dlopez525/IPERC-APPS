<?php

namespace App\Http\Controllers;

use App\Activity;
use App\SubProcess;
use App\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
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
        // $jobpositions = JobPosition::with('subProcess.zone.area')->whereHas('subProcess.zone.area', function ($query)
        // {
        //     return $query->where('headquarter_id', $this->headquarter)->select('id');
        // })->get(['id', 'name', 'sub_process_id']);

        $subProcesses =  SubProcess::with('zone:id,name')->whereHas('zone.area.JobPosition', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })->get(['id','name','zone_id']);

        return view('general.activities.index', compact('subProcesses'));
    }

    public function dt()
    {
        $data = Activity::with('subProcess:id,name')->whereHas('subProcess.zone.area.JobPosition', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })->get(['id','name','sub_process_id']);

        return datatables()->of($data)->toJson();
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->el_id != null || $request->el_id != '') {
                $el = Activity::find($request->el_id);
            } else {
                $el = new Activity;
            }

            $el->name = $request->name;
            $el->sub_process_id = $request->sub_process;
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
        $el = Activity::select(['name', 'sub_process_id','id'])->find($request->el_id);

        return response()->json($el);
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $el = Activity::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }
}
