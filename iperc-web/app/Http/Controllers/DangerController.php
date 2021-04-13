<?php

namespace App\Http\Controllers;

use App\Danger;
use App\Consequence;
use App\DangerDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DangerController extends Controller
{
    public $headquarter;

    public function __construct ()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->headquarter = session()->has('headlocal') == true ? session()->get('headlocal') : auth()->user()->headquarter_id;
            return $next($request);
        });
    }

    public function index()
    {
        $dangers = Danger::where('headquarter_id', $this->headquarter)->get(['id','name','img']);
        return view('general.dangers.index', compact('dangers'));
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->el_id != null || $request->el_id != '') {
                $el = Danger::find($request->el_id);
            } else {
                $el = new Danger;
                $el->headquarter_id = $this->headquarter;
            }

            $el->name = $request->name;

            if ($request->hasFile('file')) {
                $path = public_path('img/dangers');

                $file = $request->file('file');

                $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $file->getClientOriginalExtension();

                $file->move($path, $name);

                $el->img = '/img/dangers/' . $name;
            } else {
                $el->img = $request->preload;
            }
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
        $el = Danger::where('headquarter_id', $this->headquarter)->select(['name','id','img'])->find($request->el_id);

        return response()->json($el);
    }

    public function detete(Request $request)
    {
        DB::beginTransaction();
        try {
            $el = Danger::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }

    /// DESCRIPTIONS

    public function indexDescription()
    {
        $dangers = Danger::where('headquarter_id', $this->headquarter)->get(['id', 'name']);
        return view('general.dangers.description', compact('dangers'));
    }

    public function dtDescription(Request $request)
    {
        $data = DangerDescription::with('danger')->whereHas('danger', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })->get();

        return datatables()->of($data)->toJson();
    }

    public function saveDescription(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->el_id != null || $request->el_id != '') {
                $el = DangerDescription::find($request->el_id);
            } else {
                $el = new DangerDescription;
            }

            $el->name = $request->description;
            $el->event = $request->event;
            $el->danger_id = $request->danger;
            $el->save();
            
            DB::commit();
            return redirect()->back()->with('info', 'Se Guardó correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ooops. Hubo un problema, intentelo nuevamente.');
        }
    }

    public function deteteDescription(Request $request)
    {
        DB::beginTransaction();
        try {
            $el = DangerDescription::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }

    public function getDescription(Request $request)
    {
        $el = DangerDescription::select(['name','event','danger_id','id'])->find($request->el_id);

        return response()->json($el);
    }

    // CONSECUENCIAS

    public function indexConsequence()
    {
        $descriptions = DangerDescription::whereHas('danger', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })->orderBy('name','asc')->get(['id','name']);

        return view('general.dangers.consecuence', compact('descriptions'));
    }

    public function dtConsequence()
    {
        $data = Consequence::with('description:id,name')->whereHas('description.danger', function ($query)
        {
            return $query->where('headquarter_id', $this->headquarter);
        })->get();

        return datatables()->of($data)->toJson();
    }

    public function saveConsequence(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->el_id != null || $request->el_id != '') {
                $el = Consequence::find($request->el_id);
            } else {
                $el = new Consequence;
            }

            $el->name = $request->consequence;
            $el->danger_description_id = $request->danger;
            $el->save();
            
            DB::commit();
            return redirect()->back()->with('info', 'Se Guardó correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ooops. Hubo un problema, intentelo nuevamente.');
        }
    }

    public function getConsequence(Request $request)
    {
        $el = Consequence::select(['name','danger_description_id','id'])->find($request->el_id);

        return response()->json($el);
    }

    public function deteteConsequence(Request $request)
    {
        DB::beginTransaction();
        try {
            $el = Consequence::find($request->el);
            $el->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }

    ///////

    public function getDangerDescriptions(Request $request)
    {
        $descriptions = DangerDescription::where('danger_id', $request->danger)->orderBy('name', 'asc')->get(['id','name']);

        return response()->json($descriptions);
    }

    public function getEventDangerDescription(Request $request)
    {
        $events = DangerDescription::where('id', $request->danger)->orderBy('event', 'asc')->get(['id','event']);

        return response()->json($events);
    }

    public function getConsecuenceDangerDescription(Request $request)
    {
        $consequences = Consequence::where('danger_description_id', $request->danger_description)->orderBy('name', 'asc')->get(['id','name']);

        return response()->json($consequences);
    }
}
