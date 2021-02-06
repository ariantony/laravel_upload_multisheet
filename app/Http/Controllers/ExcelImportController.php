<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use App\Imports\MultiSheet;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ImportExcel(Request $request)
    {

        $file = $request->file('file');
        Excel::import(new MultiSheet, $file);

    }

    public function TestCollection()
    {

        $data = User::all()->toArray();

        dd($data);


        foreach ($data as $key=>$val) {

            //return $val;
        }


        //return $data;

        $average = collect([
            ['a' => 10],
            ['b' => 20],
            ['c' => 30],
            ['d' => 40]
        ]);

        //print_r($average);

    }



    public function excel(Request $request)
    {
        $file = $request->file('file');

        $koleksi = Excel::toCollection(new ExcelImport, $file);

        // return collect($koleksi)->map(function($item, $key) {
        //     return $item;
        // });

        $index = 0;
        $take = [];

        foreach ($koleksi as $key1 => $value1) {

            if($index < 2) {

                $take[$key1] = $value1;
            }

            $index++;

        }

        return $take;

        // foreach ($koleksi as $key1=>$value1 ) {
        //     //@reset($value1);
        //     foreach ($value1 as $key2=>$value2 ) {
        //         //@reset($value2);
        //         $no = 0;
        //         foreach ($value2 as $key3=>$value3 ) {
        //             if($no == 0) {
        //                 $keyname[$no] = $value3;
        //             }
        //             if($no > 1) {
        //                 $data[$key1][$keyname[1]] = $value3[1];

        //             }
        //             $no++;
        //         }
        //     }
        // }
        // dd($data);
    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
