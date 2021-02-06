<?php

namespace App\Imports;

use App\Imports\Modul1\BonusImport;
use App\Imports\Modul1\BPJS_KerImport;
use App\Imports\Modul1\BPJS_KesImport;
use App\Imports\Modul1\PajakImport;
use App\Imports\Modul1\Potongan_AbsenImport;
use App\Imports\Modul1\PotonganImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheet implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Tunjangan' => new TunjanganImport(),
            'Bonus' => new BonusImport(),
            'Potongan' => new PotonganImport(),
            'Potongan_Absen'=> new Potongan_AbsenImport(),
            'BPJS_Kes' => new BPJS_KesImport(),
            'BPJS_Ker' => new BPJS_KerImport(),
            'Pajak' => new PajakImport(),
        ];
    }
}
