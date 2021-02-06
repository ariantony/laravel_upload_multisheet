<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TunjanganImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    /*
    1. Membuat variable array kosong kita namakan #data
    2. Me-looping tingkat 1, dan menghilangkan array dengan key = 0
    3. Membuat pengulangan yang dimulai dari key 3
       hingga selesai dengan kunci nip yang berada pada $key2
    */
    public function collection(Collection $collection)
    {
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


