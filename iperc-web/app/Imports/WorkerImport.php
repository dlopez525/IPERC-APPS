<?php

namespace App\Imports;

use App\Worker;
use App\Headquarter;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WorkerImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
    use Importable;
    

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['SEDE'])) {
            return null;
        }

        $sede = $row['SEDE'];
        $sap = $row['SAP'];
        $name = $row['NOMBRE Y APELLIDOS'];

        $userExist = Worker::where('sap', $sap)->first();
        $headquarter = Headquarter::firstOrCreate(['name' => $sede]);
        $user = null;

        if ($userExist == null) {
            $user = Worker::create([
                'name' => $name,
                'sap' => $sap,
                'headquarter_id' => $headquarter->id,
            ]);
        }

        return $user;
    }
}
