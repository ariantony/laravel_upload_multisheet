<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\KompenenImport;
use Maatwebsite\Excel\Facades\Excel;

class CollectionImportController extends Controller
{
    public function show() {

        return 'testtttt';

    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('import');

        $import = Excel::toCollection(new KompenenImport, $file);

        dd($import);

        return  $import;
    }


}
