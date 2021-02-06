<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use MaatWebsite\Excel\Concerns\ToCollection;

class KompenenImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            User::create([
                'name' => $row[0],
            ]);
        }
    }
}
