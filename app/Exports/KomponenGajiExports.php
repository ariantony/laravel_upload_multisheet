<?php

namespace App\Exports;

use App\Http\Controllers\KomponenGajiController;
use App\Models\Employee;
use App\Models\KomponenGaji;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class KomponenGajiExports implements
    FromCollection,
    ShouldAutoSize,
    WithHeadings,
    WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function collection()
    {

        $employee = Employee::all('nip','firstname');

        $add_number = $employee->map(function ($item, $index) {
            $item['number'] =  $index + 1;
            return $item;
        });


        $komponen = KomponenGaji::all('code','name');


        // $query = DB::table('mst_komponen')
        // ->select('code','name')
        // ->whereRaw('length(acc_code)= ?', 5)
        // ->whereRaw('length(code) > ?', 0)
        // ->orderBy('acc_code')
        // ->get();

      return $add_number ;
        //return $query;

    }

    public function headings(): array {

        return [
            'Number',
            'Nip',
            'Nama'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:B1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFA0A0A0',
                        ]
                    ],
                ]);
            }
        ];

    }
}
