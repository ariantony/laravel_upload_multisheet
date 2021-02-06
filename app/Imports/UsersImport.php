<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements WithMultipleSheets

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    //Use Importable, SkipsErrors;

    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport(),
            1 => new SecondSheetImport(),
        ];
    }

    // public function headingRow(): int
    // {
    //     return 0;
    // }


}
