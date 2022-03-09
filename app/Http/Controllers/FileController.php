<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public $people = [
        0 => [
            "Name" => "Dhruvi",
            "State" => 'TX',
            "Salary" => 99099,
            'Grade' => 100,
            'Room' => 550,
            'Telnum' => 100010,
            'Picture' => 'dhru.jpg',
            'Keywords' => 'Dhruvi is nice'
        ],
        1 => [
            "Name" => "Chuck",
            "State" => 'TX',
            "Salary" => 99099,
            'Grade' => 100,
            'Room' => 550,
            'Telnum' => 100010,
            'Picture' => 'dhru.jpg',
            'Keywords' => 'Dhruvi is nice'
        ],
        2 => [
            "Name" => "Meena",
            "State" => 'TX',
            "Salary" => 99099,
            'Grade' => 100,
            'Room' => 550,
            'Telnum' => 100010,
            'Picture' => 'dhru.jpg',
            'Keywords' => 'Dhruvi is nice'
        ],
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('edit', $this->people);
        //
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
        try {
            $request->validate([
                'fileToUpload' => 'required|mimes:jpeg,png,jpg,gif,svg,csv|max:2048',
            ]);
            $name = $request->fileToUpload->getClientOriginalName();
            $filePath = $request->file('fileToUpload')->storeAs('uploads/', $name, 'azure');
            return view('welcome', ['message' => 'File has been Uploaded successfully']);
            /**
             * Check if the file type is csv or Image
             * if Image then save this image to Storage Account
             * If CSV then convert it to Array, Then save this to variable or Azure SQL server
             */
        } catch (\Exception $e) {
            return view('welcome', ['message' => 'File format is not supported']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $fileName = $request->get('name') ? 'uploads/'.$request->get('name').'.jpg' : NULL ;
//        var_dump($request->get('greaterThan'));
//        var_dump($request->get('lessThan'));
        $disk = Storage::disk('azure');
var_dump($fileName);
        if (!$disk->exists($fileName))
        {
            die('in here');
            abort(404);
        }
        echo 'Filename is '.$fileName;
        $contents = $disk->get($fileName);
        var_dump($contents);
        die('in here');
        return response($contents)->header('content-type', 'image/jpg');
//        die('in here');
//        return 'in here';
//        echo 'in here';
//        die('die please');
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
        echo 'id is '.$id;
        echo '<br>';
        var_dump($request->json());
        return 'hey there you are in update';
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
