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
            $request->validate([
                'className' => 'required|max:2'
            ]);
            $result = DB::insert('Insert into class(name, limit) values (?, ?)',
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


    public function createStudent(Request  $request){
      print_r($request->all());
        if($request->get('className') && $request->get('studentId')){
            $doesStudentExist = DB::select('SELECT student_id from student where student_id = ?', [
                $request->get('studentId')
            ]);
            if($doesStudentExist){
                $result = DB::insert('Insert into class_student(class_name, student_id) values (?, ?)',
                    [ $request->get('className'),$request->get('studentId') ]);
                if($result){
                    return view('quiz8/addStudent', ['message' => 'record inserted successfully']);
                }
            }else{
                return view('quiz8/addStudent', ['message' => 'Student Id not found successfully']);
            }
//            var_dump($doesStudentExist);
//            die('in here');
        }
      return view('quiz8/addStudent');
    }

    public function getStudents(Request  $request){
        print_r($request->all());
        if($request->get('className')){
            $result = DB::select('Select * from class_student where class_name = ?',
                [ $request->get('className') ]);
            $records = json_decode(json_encode($result), true);
            $count = count($records);
            return view('quiz8/getStudents', ['records' => $records, 'count' => $count,
                'message' => 'records found successfully']);
//            if($result){
//                return view('quiz8/addStudent', ['message' => 'record inserted successfully']);
//            }
        }
        return view('quiz8/getStudents');
    }

    public function removeStudent(Request $request){
        print_r($request->all());
        if($request->get('className') && $request->get('studentId')){
            $result = DB::delete ('Delete from class_student where class_name = ? and student_id = ?',
                [ $request->get('className'),$request->get('studentId') ]);
            if($result){
                return view('quiz8/removeStudent', ['message' => 'record Removed successfully']);
            }
        }
        return view('quiz8/removeStudent');
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
