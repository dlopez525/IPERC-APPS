<?php

namespace App\Http\Controllers;

use App\User;
use App\Worker;
use App\Headquarter;
use Illuminate\Http\Request;
use App\Imports\WorkerImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
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

    public function indexAdmin()
    {
        $headquarters = Headquarter::get(['id','name']);
        $users = User::with('headquarter')->where('id', '!=', 1)->get(['id', 'headquarter_id', 'name', 'email', 'sap','type_user']);

        return view('usuarios.admins.index', compact('users','headquarters'));
    }

    public function saveAdmin(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->user_id != null || $request->user_id != '') {
                $user = User::find($request->user_id);
            } else {
                $user = new User;
            }

            $user->name = $request->name;
            $user->sap = $request->sap;
            $user->email = $request->email;
            if ($request->password != '' || $request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->headquarter_id = $request->headquarter_id;
            $user->type_user = $request->type;
            $user->save();
            
            DB::commit();
            return redirect()->back()->with('info', 'Se Guardó el usuario correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ooops. Hubo un problema intentelo nuevamente.');
        }
    }

    public function getAdmin(Request $request)
    {
        $user = User::select(['name','email','headquarter_id','sap','id','type_user'])->find($request->user_id);

        return response()->json($user);
    }

    public function deleteAdmin(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->user_id);
            $user->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }
    /**
     *  Workers
     */
    public function indexWorker()
    {
        $headquarters = Headquarter::get(['id','name']);

        return view('usuarios.workers.index', compact('headquarters'));
    }

    public function dt_workera(Request $request)
    {
        if (auth()->user()->isSuperAdmin()) {
            $users = Worker::with('headquarter')
                            ->where(function ($query) use($request) {
                                if($request->get('sede') != ''){
                                    $query->where('headquarter_id', $request->sede);
                                }
                            })
                            ->orderBy('name', 'asc')
                            ->get(['id', 'headquarter_id', 'name', 'sap']);
        } else {
            $users = Worker::with('headquarter')
                            ->where('headquarter_id', $this->headquarter)
                            ->orderBy('name', 'asc')
                            ->get(['id', 'headquarter_id', 'name', 'sap']);
        }

        return datatables()->of($users)->toJson();
    }

    public function saveWorker(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->user_id != null || $request->user_id != '') {
                $user = Worker::find($request->user_id);
            } else {
                $user = new Worker;
            }

            // $user->name = $request->name;
            $user->sap = $request->sap;
            $user->headquarter_id = $this->headquarter;
            $user->save();
            
            DB::commit();
            return redirect()->back()->with('info', 'Se Guardó el usuario correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ooops. Hubo un problema intentelo nuevamente.');
        }
    }

    public function getWorker(Request $request)
    {
        $user = Worker::select(['name','headquarter_id','sap','id'])->find($request->user_id);

        return response()->json($user);
    }

    public function deleteWorker(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Worker::find($request->user_id);
            $user->delete();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }

    public function importWorker(Request $request)
    {
        Excel::import(new WorkerImport,request()->file('file'));
           
        return back()->with('info', 'Se agregaron los trabajadores con Éxito');
    }
}
