<?php

namespace App\Imports;

use App\IpercFile;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HeaderIpercImport implements ToModel, WithMappedCells, WithMultipleSheets
{
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

    public function mapping(): array
    {
        return [
            'responsable'  => 'D6',
            'create' => 'D7',
            'update' => 'D8',
            'leader' => 'H7',
            'team' => 'H8',
        ];
    }
    
    public function model(array $row)
    {
        $update = $this->transformDate($row['update']);
        $create = $this->transformDate($row['create']);

        $xls = IpercFile::find($this->file);
        $xls->responsable = $row['responsable'];
        $xls->creation_date = $create;
        $xls->last_update = $update;
        $xls->leader = $row['leader'];
        $xls->team = $row['team'];
        $xls->save();

        return $xls;
    }

    public function transformDate($value)
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format('Y-m-d');;
        } catch (\ErrorException $e) {
            return date('Y-m-d', strtotime($value));
        }
    }
}
