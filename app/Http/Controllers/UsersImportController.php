<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersImportController extends Controller
{
    public function show() {

        return 'tstfff';

    }

    public function store(Request $request) {
        $file = $request->file('file')->store('import');


        $collection = Excel::toCollection(new UsersImport, $file);

        print_r($collection);

        //return $collection;

    }
}
