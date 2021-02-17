<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class template implements FromArray, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

	var $setColumn = 0;

    use Exportable;

    public function array(): array
    {
        $employee = DB::table('trs_employee')
            ->select('nip','firstname')
            ->orderBy('nip')
            ->get()->toArray();

        $dbhr = collect($employee)->map(function($x){
            return (array) $x;
        })->toArray();

        $komponen= DB::table('mst_komponen')
            ->select('acc_code','name')
            ->whereRaw('length(acc_code) = 5')
            ->whereNotNull('code')
            ->orderBy('acc_code')
            ->get()->toArray();



        $dbkomponen = collect($komponen)->map(function($x){
            return (array) $x;
        })->toArray();

        $this->setColumn = count($dbkomponen);

        //dd($dbkomponen);

        //dd($dbkomponen);
        $no = 0;
        foreach($dbhr as $x=>$y) {
            $no++;
            foreach($dbkomponen as $x1=>$y1) {
                if($x == 0) {
                    //untuk header baris 1
                    $key = $x;
                    $hasil[$key]['no'] = 'no';
                    $hasil[$key]['nip'] = 'nip';
                    $hasil[$key]['name'] = 'name';
                    $hasil[$key][$y1['acc_code']] = $y1['acc_code'];
                    $key++;
                    //untuk header baris 2
                    $hasil[$key]['no'] = 'No.';
                    $hasil[$key]['nip'] = 'NIP';
                    $hasil[$key]['name'] = 'Nama';
                    $hasil[$key][$y1['acc_code']] = $y1['name'];
                    $key++;
                }
                    //rows data nilai
                $hasil[$key]['no'] = $no;
                $hasil[$key]['nip'] = $y['nip'];
                $hasil[$key]['name'] = $y['firstname'];
                $hasil[$key][$y1['acc_code']] = 0 ;
            }
            $key++;
        }

        return $hasil;

    }

    public function columnLetter($c){

        $c = intval($c);

        if ($c <= 0) {
            return '';
        }

        $letter = '';

        while($c != 0){
           $p = ($c - 1) % 26;
           $c = intval(($c - $p) / 26);
           $letter = chr(65 + $p) . $letter;
        }

        return $letter;

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:Z1')->applyFromArray([
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
