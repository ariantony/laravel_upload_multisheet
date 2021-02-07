<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        //dump($collection);

        $data = array();
        foreach ($collection as $key1=>$value1 ) {
                $no = 0;
                $pin = "";
                foreach ($value1 as $key2=>$value2 ) {
                    if($no == 2) {
                        $pin = $value2;
                    }
                    if($no > 2) {
                        $data[$pin][$key2]['pin'] = $pin;
                        $data[$pin][$key2]['tgl'] = gmdate("Y-m-d", (($key2 - 25569) * 86400));
                        $data[$pin][$key2]['jadwal'] = $value2;
                    }
                    $no++;

                }
        }
        dump($data);
    }

    public function headingRow(): int
    {
        return 1;
    }

}
