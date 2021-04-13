<?php

namespace App\Http\Controllers;

use App\Headquarter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeadquarterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $headquarters = Headquarter::get(['id', 'name']);
        return view('sedes.index', compact('headquarters'));
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->headquarter_id != null || $request->headquarter_id != '') {
                $headquarter = Headquarter::find($request->headquarter_id);
            } else {
                $headquarter = new Headquarter;
            }

            $headquarter->name = $request->name;
            $headquarter->save();

            DB::commit();
            return redirect()->back()->with('info', 'Se Guardó la sede correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Ooops. Hubo un problema intentelo nuevamente.');
        }
    }

    public function get(Request $request)
    {
        $headquarter = Headquarter::find($request->headquarter_id);

        return response()->json($headquarter);
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $headquarter = Headquarter::find($request->headquarter_id);
            $headquarter->delete();

            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
