<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    public function view(): View
    {
        return view('exports.user', [
            'user' => User::all()
        ]);
    }
}
