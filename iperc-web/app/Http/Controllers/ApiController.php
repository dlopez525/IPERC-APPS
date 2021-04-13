<?php

namespace App\Http\Controllers;

use App\Area;
use App\Task;
use App\Zone;
use App\Audit;
use App\Iperc;
use App\Worker;
use App\Activity;
use App\SubProcess;
use App\Headquarter;
use App\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AreaCollection;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\IpercCollection;
use App\Http\Resources\DangerCollection;
use App\Http\Resources\ActivityCollection;
use App\Http\Resources\SubProcessCollection;
use App\Http\Resources\Worker as WorkerResource;
use App\Http\Resources\ZoneCollection as ZoneCollection;
use App\Http\Resources\HeadquarterCollection as HeadquarterCollection;
use App\Http\Resources\JobPositionCollection as JobPositionCollection;

class ApiController extends Controller
{
    public function getHeadquarters()
    {
        return new HeadquarterCollection(Headquarter::all());
    }

    public function apiLogin(Request $request)
    {
        $headquarter = $request->headquarter;
        $sap = $request->sap;

        $worker = Worker::where('sap', $sap)->where('headquarter_id', $headquarter)->first();

        if ($worker != null) {
            return response()->json(new WorkerResource($worker));
        }

        return response()->json(false);
    }

    public function getJobPositions(Request $request)
    {
        $headquarter = $request->headquarter;

        $jobPositions = JobPosition::where('headquarter_id', $headquarter)->select('name')->distinct()->get();

        return response()->json(new JobPositionCollection($jobPositions));
    }

    public function getAreas(Request $request)
    {
        $jobPosition = $request->job_position;
        
        $areas = Area::join('job_positions','areas.job_position_id', '=', 'job_positions.id')
                 ->where('job_positions.name', 'like', '%' . $jobPosition . '%')
                 ->where('job_positions.headquarter_id', $request->headquarter)
                 ->select('areas.name')->distinct()->get();

        return response()->json(new AreaCollection($areas));
    }

    public function getZones(Request $request)
    {
        $area = $request->area;
        $jobPosition = $request->job_position;
        $headquarter = $request->headquarter;

        $zone = Zone::join('areas', 'zones.area_id', '=', 'areas.id')
                 ->join('job_positions','areas.job_position_id', '=', 'job_positions.id')
                 ->where('areas.name', '=', $area)
                 ->where('job_positions.name', '=', $jobPosition)
                 ->where('job_positions.headquarter_id', '=', $headquarter)
                 ->select('zones.*')->get();

        return response()->json(new ZoneCollection($zone));
    }

    public function getSubProcesses(Request $request)
    {
        $zone = $request->zone;

        $subProcess = SubProcess::where('zone_id', $zone)->get();

        return response()->json(new SubProcessCollection($subProcess));
    }

    public function audit(Request $request)
    {
        DB::beginTransaction();
        try {
            $area = Zone::with('area:id,name')->select('area_id')->find($request->zone);

            $audit = new Audit;
            $audit->headquarter_id = $request->headquarter;
            $audit->worker_id = $request->worker;
            $audit->area_id = $area->area_id; //$request->area;
            $audit->area = $area->area->name;
            $audit->date = date('Y-m-d');
            $audit->save();
            
            DB::commit();
            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }

    public function getActivities(Request $request)
    {
        $subProcess = $request->sub_process;

        $activity = Activity::where('sub_process_id', $subProcess)->get();

        return response()->json(new ActivityCollection($activity));
    }

    public function getTasks(Request $request)
    {
        $activity = $request->activity;

        $tasks = Task::where('activity_id', $activity)->get();

        return response()->json(new TaskCollection($tasks));
    }

    public function getTaskDanger(Request $request)
    {
        $task = $request->task;

        $task = Task::with('dangers')->find($task);

        $dangers = $task->dangers;

        return response()->json(new DangerCollection($dangers));
    }

    public function getIperc(Request $request)
    {
        $danger = $request->danger;
        $task = $request->task;

        $iperc = Iperc::with('task', 'danger', 'consequence', 'dangerDescription', 'risk','file:id,last_update')->where('danger_id', $danger)->where('task_id', $task)->get();

        $description = array();
        $descriptiones = array();

        $cont = 0;
        $cont2 = 0;

        foreach ($iperc as $i) {
            if (! in_array($i->dangerDescription->name, $descriptiones)) {
                $descriptiones[] =  $i->dangerDescription->name;
                $description[$cont]['id'] = $i->id;
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
                        );

                        break;
                    }
                }
            }

        }

        // dd($description);

        return response()->json($description);
        // return response()->json(new IpercCollection($iperc));
    }
}
