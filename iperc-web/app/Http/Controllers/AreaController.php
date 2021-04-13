<?php

namespace App\Http\Controllers;

use App\Area;
use App\Headquarter;
use App\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
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
        $jobPositions = JobPosition::where('headquarter_id', $this->headquarter)->get(['id','name']);
        return view('general.areas.index', compact('jobPositions'));
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->el_id != null || $request->el_id != '') {
                $el = Area::find($request->el_id);
            } else {
                $el = new Area;
            }

            $el->job_position_id = $request->job_position;
            $el->name = $request->name;
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
        $el = Area::select(['name','id','job_position_id'])->find($request->el_id);

        return response()->json($el);
    }

    public function dt(Request $request)
    {
        $data = Area::with('JobPosition:id,iperc_file_id','JobPosition.file:id,name')->whereHas('JobPosition', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })
                        ->get(['id', 'name','job_position_id']);

        return datatables()->of($data)->toJson();
    }

    public function detete(Request $request)
    {
        DB::beginTransaction();
        try {
            $el = Area::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }
}
