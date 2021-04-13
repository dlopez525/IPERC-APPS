<?php

namespace App\Http\Controllers;

use App\Area;
use App\Task;
use App\Zone;
use App\Audit;
use App\Iperc;
use App\Worker;
use App\SubProcess;
use App\Headquarter;
use App\JobPosition;
use Illuminate\Http\Request;
use App\Http\Resources\IpercCollection;
use App\Http\Resources\JobPositionCollection;

class WorkerController extends Controller
{
    public function login()
    {
        session()->forget('isession');
        
        $headquarters = Headquarter::get(['id', 'name']);

        return view('workers.login', compact('headquarters'));
    }

    public function authenticate(Request $request)
    {
        $headquarter = $request->headquarter;
        $sap = $request->sap;

        $worker = Worker::where('sap', $sap)->where('headquarter_id', $headquarter)->first();

        if ($worker == null) {
            return redirect()->back()->with('error', 'Datos Incorrectos');
        }
        session(['isession' => time()]);
        return redirect()->route('workerhome', ['headquarter' => $headquarter, 'worker' => $worker->id]);
    }

    public function welcome($worker, $headquarter)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }
        // $areas = Area::where('headquarter_id', $headquarter)->get(['name', 'id']);
        //$jobPositions = JobPosition::where('headquarter_id', $headquarter)->get(['name', 'id']);
        $jobPositions = new JobPositionCollection(JobPosition::where('headquarter_id', $headquarter)->select('name')->distinct()->get());

        $worker = Worker::select('name', 'id')->find($worker);

        return view('workers.home', compact('jobPositions', 'worker','headquarter'));
    }

    public function welcomeProcess(Request $request)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }

        $area = Zone::select('area_id')->find($request->zone);

        $audit = new Audit;
        $audit->headquarter_id = $request->headquarter;
        $audit->worker_id = $request->worker;
        $audit->area_id = $area->area_id; //$request->area;
        $audit->area = $area->area->name;
        $audit->date = date('Y-m-d');
        $audit->save();

        $zone = $request->zone;

        return redirect()->route('criteria', ['zone' => $zone]);
    }

    public function criteria($zone)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }

        $subProcesses = SubProcess::where('zone_id', $zone)->get(['name', 'id']);
        // $jobPositions = JobPosition::where('sub_process_id', $subProcess);

        return view('workers.criterios', compact('subProcesses'));
    }

    public function criteriaProcess(Request $request)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }

        $activity = $request->activity;

        return redirect()->route('tasks', ['activity' => $activity]);
    }

    public function tasks($activity)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }

        $tasks = Task::where('activity_id', $activity)->get(['id', 'name']);

        return view('workers.tareas', compact('tasks'));
    }

    public function tasksProcess(Request $request)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }

        $task = $request->task;

        return redirect()->route('dangers', ['task' => $task]);
    }

    public function taskDangers($task)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }

        $tarea = $task;

        $task = Task::find($task);

        $dangers = $task->dangers;

        return view('workers.tipos-peligro', compact('dangers', 'tarea'));
    }

    public function taskDangerProcess(Request $request)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }

        $danger = $request->danger;
        $task = $request->task;

        return redirect()->route('workers.iperc', ['task' => $task, 'danger' => $danger]);
    }

    public function getIperc($task, $danger)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }

        $iperc = Iperc::with('task', 'danger', 'consequence', 'dangerDescription', 'risk')->where('danger_id', $danger)->where('task_id', $task)->get();

        $description = array();
        $descriptiones = array();

        $cont = 0;
        $cont2 = 0;

        foreach ($iperc as $i) {
            if (! in_array($i->dangerDescription->name, $descriptiones)) {
                $descriptiones[] =  $i->dangerDescription->name;
                $description[$cont]['id'] = $this->generateRandomString();
                // $description[$cont]['id'] = $i->id;
                $description[$cont]['last_update'] =  date('d-m-Y', strtotime($i->file->last_update));
                $description[$cont]['danger_description'] = $i->dangerDescription->name;
                $description[$cont]['dangers_descriptions'] = array(
                    array(
                        'risk_color' => $i->risk->color,
                        'risk_color_rgba' => $i->risk->color_rgba,
                        'risk_name' => $i->risk->slug,
                        'event' => $i->dangerDescription->event,
                        'consequence' => $i->consequence->name,
                        'engineering_controls' => $i->engineering_controls,
                        'administrative_controls' => $i->administrative_controls,
                        'epps' => $i->epps,
                        'risk' => $i->risk->name,
                        'danger' =>  $i->danger->name,
                        'task' =>  $i->task->name,
                        'id' => $i->id
                    )
                );
                $cont++;
            } else {
                foreach ($description as $key => $d) {
                    if ($d['danger_description'] == $i->dangerDescription->name) {
                        $description[$key]['dangers_descriptions'][1] = array(
                            'risk_color' => $i->risk->color,
                            'risk_color_rgba' => $i->risk->color_rgba,
                            'risk_name' => $i->risk->slug,
                            'event' => $i->dangerDescription->event,
                            'consequence' => $i->consequence->name,
                            'engineering_controls' => $i->engineering_controls,
                            'administrative_controls' => $i->administrative_controls,
                            'epps' => $i->epps,
                            'risk' => $i->risk->name,
                            'danger' =>  $i->danger->name,
                            'task' =>  $i->task->name,
                            'id' => $i->id
                        );

                        break;
                    }
                }
            }

        }

        $ipercs = $description;

        return view('workers.iperc', compact('ipercs'));
    }

    function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getControls($iperc)
    {
        if (!session()->exists('isession')) {
            return redirect()->route('wlogin')->with('error', 'Debe de Identificarse para hacer una Consulta');
        }

        $iperc = Iperc::select('engineering_controls','administrative_controls','epps')->find($iperc);

        return view('workers.controls', compact('iperc'));
    }
}
