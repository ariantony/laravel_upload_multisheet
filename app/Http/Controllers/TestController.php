<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\KomponenGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test() {

        $collection = collect([1, 2, 3, 4, 5]);

        $multiplied = $collection->map(function ($item, $key) {
            return $item ;
        });

        dump($multiplied); // keluarannya collection

        $test = $multiplied->all();

        dump($test); // keluarannya array


    }


    public function test2() {


        $employee = DB::table('trs_employee')
            ->select('nip','firstname')
            ->orderBy('nip')
            ->get()->toArray();

        $dbhr = collect($employee)->map(function($x){
            return (array) $x;
        })->toArray();

        //dd($data_employee);


        $komponen= DB::table('mst_komponen')
            ->select('acc_code','name')
            ->whereRaw('length(acc_code) = 5')
            ->whereNotNull('code')
            ->orderBy('acc_code')
            ->get()->toArray();

        $dbkomponen = collect($komponen)->map(function($x){
            return (array) $x;
        });

        //dd($dbkomponen);

        foreach($dbhr as $x=>$y) {
            foreach($dbkomponen as $x1=>$y1) {
                $hasil[$y['nip']]['nip'] = $y['nip'];
                $hasil[$y['nip']]['firstname'] = $y['firstname'];
                $hasil[$y['nip']]['komponen'][$y1['acc_code']] = $y1;
            }
        }

        dd($hasil, $y);

    }

    public function test3() {


        $employee = DB::table('trs_employee')
            ->select('nip','firstname')
            ->orderBy('nip')
            ->get()->toArray();

        $dbhr = collect($employee)->map(function($x){
            return (array) $x;
        })->toArray();

        //dd($data_employee);


        $komponen= DB::table('mst_komponen')
            ->select('acc_code','name')
            ->whereRaw('length(acc_code) = 5')
            ->whereNotNull('code')
            ->orderBy('acc_code')
            ->get()->toArray();

        $dbkomponen = collect($komponen)->map(function($x){
            return (array) $x;
        })->toArray();

        //dd($dbkomponen);

        $no = 0;
        foreach($dbhr as $x=>$y) {
            $no++;
            foreach($dbkomponen as $x1=>$y1) {
                if($x == 0) {
                    //untuk header baris 1
                    $key = $x;
                    $hasil[$key]['no'] = 'no';
                    $hasil[$key]['nip'] = 'nip';
                    $hasil[$key]['name'] = 'name';
                    $hasil[$key][$y1['acc_code']] = $y1['acc_code'];
                    $key++;
                    //untuk header baris 2
                    $hasil[$key]['no'] = 'No.';
                    $hasil[$key]['nip'] = 'Kode nip';
                    $hasil[$key]['name'] = 'Nama';
                    $hasil[$key][$y1['acc_code']] = $y1['name'];
                    $key++;
                }
                    //rows data nilai
                $hasil[$key]['no'] = $no;
                $hasil[$key]['nip'] = $y['nip'];
                $hasil[$key]['name'] = $y['firstname'];
                $hasil[$key][$y1['acc_code']] = 0 ;
            }
            $test = collect($hasil);
            $key++;
        }

        $test = collect($hasil);
        dd($test);
    }

    public function index()
    {

        $query = DB::table('mst_komponen')
        ->select('acc_code','code','name')
        ->whereRaw('length(acc_code) = 5')
        ->whereNotNull('code')
        ->orderBy('acc_code')
        ->get()->toArray();

        $data_komponen = collect($query)->map(function($x){
            return (array) $x;
        })->keyBy('code')->toArray();

        //dd($data_komponen);

        $data_employee = DB::table('trs_employee')
                ->select('nip','firstname')
                ->orderBy('nip')
                ->get()->toArray();

                $data = array();
                foreach ($data_employee as $key1=>$value1 ) {
                        $no = 0;
                        $nip = "";
                        foreach ($value1 as $key2=>$value2 ) {
                            if($no == 1) {
                                $nip = $value2;
                            }
                            if($no > 2) {
                                $data[$nip][$key2]['nip'] = $nip;
                                $data[$nip][$key2]['acc_code'] = $data_komponen[$key2]['acc_code'];
                                $data[$nip][$key2]['code'] = $key2;
                                $data[$nip][$key2]['recdate'] = '2021-02-05';
                                $data[$nip][$key2]['tid'] = 1;
                                $data[$nip][$key2]['fvalue'] = $value2;
                                $data[$nip][$key2]['opttax'] = $data_komponen[$key2]['opttax'];
                                $data[$nip][$key2]['att'] = '';
                            }
                            $no++;
                    }
                }
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
