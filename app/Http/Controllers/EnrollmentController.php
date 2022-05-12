<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function createClassName(Request $request){
        print_r($request->all());
//        die('in here');
//        echo $request->get('magMinRange');
//             echo $request->get('magMaxRange');
//        echo $request->get('place');
////        die('in here');
//        $magMinRange = (float)$request->get('magMinRange');
//        $magMaxRange = (float)$request->get('magMaxRange');
        if($request->get('className')){
            $result = DB::select('Insert into class(name, limit) values (?, ?)',
                [ $request->get('className'),$request->get('limit') ]);
            if($result){
                return view('quiz8/quiz8', ['message' => 'record inserted successfully']);
            }
        }

//        var_dump($result);
//        $records = json_decode(json_encode($result), true);
//        $count = count($records);
//        print_r($records);
        return view('quiz8/quiz8');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
