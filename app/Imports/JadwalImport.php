<?php

namespace App\Imports;

use App\Models\trs_jadwal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use function PHPUnit\Framework\isNull;

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
                        // $data[$pin][$key2]['pin'] = $pin;
                        // $data[$pin][$key2]['tgl'] = gmdate("Y-m-d", (($key2 - 25569) * 86400));
                        // $data[$pin][$key2]['jadwal'] = $value2;

                        //DB::insert('insert into trs_jadwal (pin, tgl, jadwal) values (?, ?, ?)', [$pin, gmdate("Y-m-d", (($key2 - 25569) * 86400)), $value2]);
                        trs_jadwal::create([
                            'code' => $pin . gmdate("Ymd", (($key2 - 25569) * 86400)),
                            'pin' => $pin,
                            'tgl' => gmdate("Y-m-d", (($key2 - 25569) * 86400)),
                            'jadwal' => $value2,

                        ]);
                    }
                    $no++;
                }
        }

        //trs_jadwal::where('jadwal', isNull())->delete();
    }

    public function headingRow(): int
    {
        return 1;
    }

}
