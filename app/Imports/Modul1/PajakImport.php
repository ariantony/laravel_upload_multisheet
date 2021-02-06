<?php

namespace App\Imports\Modul1;

use App\Models\KomponenGaji;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PajakImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        $query = KomponenGaji::all();



        $a =  $query->where('acc_code','10001')->toArray();

        dd($a);


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
                        $data[$nip][$key2]['acc_code'] = '';
                        $data[$nip][$key2]['code'] = $key2;
                        $data[$nip][$key2]['recdate'] = '2021-02-05';
                        $data[$nip][$key2]['tid'] = 1;
                        $data[$nip][$key2]['fvalue'] = $value2;
                        $data[$nip][$key2]['opttax'] = 1;
                        $data[$nip][$key2]['att'] = '';
                    }
                    $no++;

                }
            }

        }

        //dd($data);

    }

    public function headingRow(): int
    {
        return 1;
    }
}
