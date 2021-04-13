<?php

namespace App\Imports;

use App\Area;
use App\Risk;
use App\Task;
use App\Zone;
use App\Iperc;
use App\Danger;
use App\Activity;
use App\SubProcess;
use App\Consequence;
use App\Headquarter;
use App\JobPosition;
use App\DangerDescription;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class IpercImport implements ToModel, WithMultipleSheets, WithHeadingRow,WithStartRow
{
    use Importable;

    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function startRow() :int
    {
        return 12;
    }

    public function model(array $row)
    {
        // dd($row);
        if (!isset($row[1])) {
            return null;
        }
        if (!isset($row[2])) {
            return null;
        }

        $headquarter = Headquarter::where('name', 'like', '%' . $row[1] . '%')->first();

        if ($headquarter == null) {
            $headquarter = new Headquarter;
            $headquarter->name = strtoupper(trim($row[1]));
            $headquarter->save();
        }

        $jobPositon = JobPosition::where('name', 'like', '%' . $row[5] . '%')->where('headquarter_id', $headquarter->id)->where('iperc_file_id', $this->file)->first();

        if ($jobPositon == null) {
            $jobPositon = new JobPosition;
            $jobPositon->name = $row[5];
            $jobPositon->headquarter_id = $headquarter->id;
            $jobPositon->iperc_file_id = $this->file;
            $jobPositon->save();
        }

        $area = Area::where('name', 'like', '%' . $row[2] . '%')->where('job_position_id', $jobPositon->id)->first();
        if ($area == null) {
            $area = new Area;
            $area->name = $row[2];
            $area->job_position_id = $jobPositon->id;
            $area->save();
        }

        $zone = Zone::where('name', 'like', '%' . $row[3] . '%')->where('area_id', $area->id)->first();

        if ($zone == null) {
            $zone = new Zone;
            $zone->name = $row[3];
            $zone->area_id = $area->id;
            $zone->save();
        }

        $subProcess = SubProcess::where('name', 'like', '%' . $row[4] . '%')->where('zone_id', $zone->id)->first();

        if ($subProcess == null) {
            $subProcess = new SubProcess;
            $subProcess->name = $row[4];
            $subProcess->zone_id = $zone->id;
            $subProcess->save();
        }

        $activity = Activity::where('name', 'like', '%' . $row[6] . '%')->where('sub_process_id', $subProcess->id)->first();

        if ($activity == null) {
            $activity = new Activity;
            $activity->name = $row[6];
            $activity->sub_process_id = $subProcess->id;
            $activity->save();
        }

        $isRoutine = $row[6] != null ? 1 : 0;

        $task = Task::where('name', 'like', '%' . $row[7] . '%')->where('activity_id', $activity->id)->first();

        if ($task == null) {
            $task = new Task;
            $task->name = $row[7];
            $task->activity_id = $activity->id;
            $task->save();
        }

        $danger = Danger::where('name', 'like', '%' . $row[10] . '%')->where('headquarter_id', $headquarter->id)->first();

        if ($danger == null) {
            $danger = new Danger;
            $danger->name = $row[10];
            $danger->headquarter_id = $headquarter->id;
            $danger->save();
        }

        $task->dangers()->attach($danger->id);

        $dangerDescription = DangerDescription::where('name', 'like', '%' . $row[11] . '%')->where('event', 'like', '%' . $row[12] . '%')
                                                ->where('danger_id', $danger->id)->first();

        if ($dangerDescription == null) {
            $dangerDescription = new DangerDescription;
            $dangerDescription->name = $row[11];
            $dangerDescription->event = $row[12];
            $dangerDescription->danger_id = $danger->id;
            $dangerDescription->save();
        }

        $consequence = Consequence::where('name', 'like', '%' . $row[13] . '%')->where('danger_description_id', $dangerDescription->id)->first();

        if ($consequence == null) {
            $consequence = new Consequence;
            $consequence->name = $row[13];
            $consequence->danger_description_id = $dangerDescription->id;
            $consequence->save();
        }

        $total_evaluation = (float) $row[17] * (float) $row[18] * (float) $row[19];
        
        $risk = '';
        if ($total_evaluation >= 400) {
            $riskf = Risk::where('min', 400)->select('id')->first();
            $risk = $riskf->id;
        } else {
            $risks = Risk::all();

            foreach ($risks as $r) {
                if ($total_evaluation >= $r->min && $total_evaluation <= $r->max) {
                    $risk = $r->id;
                }
            }
        }
        
        $iperc = new Iperc;
        $iperc->type_job = ($row[6] != null) ? "1" : (($row[7] != null)  ? "2" : (($row[8] != null)  ? "3" : "0"));
        $iperc->consequence_evaluation = $row[17];
        $iperc->exhibition_evaluation = $row[18];
        $iperc->probability_evaluation = $row[19];
        $iperc->total_evaluation = $total_evaluation;
        $iperc->engineering_controls = $row[14];
        $iperc->administrative_controls = $row[15];
        $iperc->epps = $row[16];
        $iperc->task_id = $task->id;
        $iperc->danger_id = $danger->id;
        $iperc->danger_description_id = $dangerDescription->id;
        $iperc->consequence_id = $consequence->id;
        $iperc->risk_id = $risk;
        $iperc->user_id = auth()->user()->id;
        $iperc->iperc_file_id = $this->file;
        $iperc->save();

        return $iperc;
    }
}
