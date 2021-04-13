<?php

namespace App\Http\Controllers;

use App\Zone;
use App\SubProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubProcessController extends Controller
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
        $zones = Zone::with('area:id,name')->whereHas('area.JobPosition', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })->get();

        return view('general.sub-processes.index', compact('zones'));
    }

    public function dt()
    {
        $data = SubProcess::with('zone:id,name')->whereHas('zone.area.JobPosition', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })->get(['id','name','zone_id']);

        return datatables()->of($data)->toJson();
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->el_id != null || $request->el_id != '') {
                $el = SubProcess::find($request->el_id);
            } else {
                $el = new SubProcess;
            }

            $el->name = $request->name;
            $el->zone_id = $request->zone;
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
        $el = SubProcess::select(['name', 'zone_id','id'])->find($request->el_id);

        return response()->json($el);
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $el = SubProcess::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }
}
