<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class template implements FromArray, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
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

        dd($komponen);

        $dbkomponen = collect($komponen)->map(function($x){
            return (array) $x;
        })->toArray();

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

        //return $hasil;

    }
}
