<?php

namespace App\Imports\Modul1;

use App\Models\KomponenGaji;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Hamcrest\Core\IsCollectionContaining;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BonusImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        /* Query dari mst_component*/
        $query = DB::table('mst_komponen')
                ->whereRaw('length(acc_code) = 5')
                ->whereNotNull('code')
                ->orderBy('acc_code')
                ->get()->toArray();

        $data_komponen = collect($query)->map(function($x){
             return (array) $x;
        })->keyBy('code')->toArray();

        //dump($data_komponen);



    /* Query dari upload excel*/
        $data = array();
        foreach ($collection as $key1=>$value1 ) {
            if ($key1 > 0) {
                $no = 0;
                $nip = "";
                foreach ($value1 as $key2=>$value2 ) {
                    if($no == 1) {
                        $nip = $value2;
                    }
                    if($no > 2) {
                        $data[$nip][$key2]['nip'] = $nip;
                        $data[$nip][$key2]['acc_code'] = $data_komponen[$key2]['acc_code'];
                        $data[$nip][$key2]['code'] = $key2;
                        $data[$nip][$key2]['recdate'] = '2021-02-05';
                        $data[$nip][$key2]['tid'] = 1;
                        $data[$nip][$key2]['fvalue'] = $value2;
                        $data[$nip][$key2]['opttax'] = $data_komponen[$key2]['opttax'];
                        $data[$nip][$key2]['att'] = '';
                    }
                    $no++;

                }
            }

        }

        //dump($data);


    }
    public function headingRow(): int
    {
        return 1;
    }

}
