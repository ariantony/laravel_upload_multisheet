<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TanggalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $results = DB::select( DB::raw("
        SELECT date_field
        FROM
        (
            SELECT
                MAKEDATE(YEAR(NOW()),1) +
                INTERVAL (MONTH(NOW())-1) MONTH +
                INTERVAL daynum DAY date_field
            FROM
            (
                SELECT t*10+u daynum
                FROM
                    (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
                    (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
                    UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
                    UNION SELECT 8 UNION SELECT 9) B
                ORDER BY daynum
            ) AA
        ) AAA
        WHERE MONTH(date_field) = MONTH(NOW());
        ") );

        $data_komponen = collect($results)->map(function($x){
            return (array) $x;
       })->pluck('date_field')->toArray();

       dd($data_komponen);




    // $data = collect($results)->map(function ($item, $key){

    //     return (array) $item;
    // })->toArray();

    dump($data);

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
