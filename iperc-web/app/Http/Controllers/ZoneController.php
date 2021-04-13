<?php

namespace App\Http\Controllers;

use App\Area;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZoneController extends Controller
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
        $areas = Area::whereHas('JobPosition', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })->get(['id', 'name']);

        return view('general.zones.index', compact('areas'));
    }

    public function dt()
    {
        $data = Zone::with('area:id,name')->whereHas('area.JobPosition', function ($query)
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
                $el = Zone::find($request->el_id);
            } else {
                $el = new Zone;
            }

            $el->name = $request->name;
            $el->area_id = $request->area;
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
        $el = Zone::select(['name', 'area_id','id'])->find($request->el_id);

        return response()->json($el);
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $el = Zone::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }
}
