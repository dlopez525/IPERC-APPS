<?php

namespace App\Http\Controllers;

use App\Task;
use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
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
        $activities = Activity::whereHas('subProcess.zone.area.JobPosition', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter)->select('id');
        })->get(['id', 'name']);

        return view('general.tasks.index', compact('activities'));
    }

    public function dt()
    {
        $data = Task::with('activity:id,name', 'activity.subProcess.zone.area.JobPosition')->whereHas('activity.subProcess.zone.area.JobPosition', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })->get();

        return datatables()->of($data)->toJson();
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->el_id != null || $request->el_id != '') {
                $el = Task::find($request->el_id);
            } else {
                $el = new Task;
            }

            $el->name = $request->name;
            $el->activity_id = $request->activity;
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
        $el = Task::select(['name', 'activity_id','id'])->find($request->el_id);

        return response()->json($el);
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $el = Task::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }
}
