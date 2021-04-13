<?php

namespace App\Exports;

use App\Iperc;
use App\IpercFile;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class IpercExport implements FromView, WithDrawings, WithEvents
{
    public $file;
    const ROW_PADDING = 5;
    const DEFAULT_CELL_WIDTH = 9.14;
    const DEFAULT_ROW_HEIGHT = 15;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('logo');
        $drawing->setPath(public_path('/img/logo-excel.png'));
        $drawing->setHeight(55);
        $drawing->setCoordinates('B1');

        return $drawing;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                //  BORDERS
                $borders = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ]
                    ]
                ];
                $event->sheet->getDelegate()->getStyle('B1:AJ4')->applyFromArray($borders);
                $event->sheet->getDelegate()->getStyle('B10:AJ11')->applyFromArray($borders);

                // ROW HEIGHT
                $event->sheet->getDelegate()->getDefaultRowDimension()->setRowHeight(-1);;

                // COLUMN WIDTH
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(2.14);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(13.57);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(28);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(28);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(22.57);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(28);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(17.43);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(17.29);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(3.86);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(3.86);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(3.86);
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(18.71);
                $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(41.14);
                $event->sheet->getDelegate()->getColumnDimension('N')->setWidth(31);
                $event->sheet->getDelegate()->getColumnDimension('O')->setWidth(19.71);
                $event->sheet->getDelegate()->getColumnDimension('P')->setWidth(12.86);
                $event->sheet->getDelegate()->getColumnDimension('Q')->setWidth(28.86);
                $event->sheet->getDelegate()->getColumnDimension('R')->setWidth(14.71);
                $event->sheet->getDelegate()->getColumnDimension('S')->setWidth(4.71);
                $event->sheet->getDelegate()->getColumnDimension('T')->setWidth(4.43);
                $event->sheet->getDelegate()->getColumnDimension('U')->setWidth(4.57);
                $event->sheet->getDelegate()->getColumnDimension('V')->setWidth(5.29);
                $event->sheet->getDelegate()->getColumnDimension('W')->setWidth(14.57);
                $event->sheet->getDelegate()->getColumnDimension('X')->setWidth(17.14);
                $event->sheet->getDelegate()->getColumnDimension('Y')->setWidth(12.86);
                $event->sheet->getDelegate()->getColumnDimension('Z')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('AA')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('AB')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('AC')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('AD')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('AE')->setWidth(4.71);
                $event->sheet->getDelegate()->getColumnDimension('AF')->setWidth(4.43);
                $event->sheet->getDelegate()->getColumnDimension('AG')->setWidth(4.57);
                $event->sheet->getDelegate()->getColumnDimension('AH')->setWidth(5.29);
                $event->sheet->getDelegate()->getColumnDimension('AI')->setWidth(11);
                $event->sheet->getDelegate()->getColumnDimension('AJ')->setWidth(12.86);

                // ALIGNMENT
                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ];
                
                $event->sheet->getDelegate()->getStyle('B10:AJ11')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('I2')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('B12:AJ600')->applyFromArray($styleArray);


                $event->sheet->getDelegate()->getStyle('B10:AJ11')->getAlignment()->setWrapText(true);
                
                $event->sheet->getDelegate()->getStyle('B12:AJ600')->getAlignment()->setWrapText(true);

                $event->sheet->getDelegate()->getStyle('I10:K10')->getAlignment()->setTextRotation(90);
                $event->sheet->getDelegate()->getStyle('S11:V11')->getAlignment()->setTextRotation(90);
                $event->sheet->getDelegate()->getStyle('AE11:AI11')->getAlignment()->setTextRotation(90);
 

                // FONT WEIGHT
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                ];
                
                $event->sheet->getDelegate()->getStyle('I2')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('B6')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('B7')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('B8')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('G7')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('G8')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('AD3')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('AD4')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('B10:AJ11')->applyFromArray($styleArray);

                foreach($event->sheet->getDelegate()->getRowDimensions() as $rd) { $rd->setRowHeight(-1); }
            },
        ];
    }

    public function view(): View
    {
        return view('iperc.excel',['ipercs' => Iperc::where('iperc_file_id', $this->file)->get(), 'file' => IpercFile::find($this->file)]);
    }
}
