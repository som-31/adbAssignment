<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\EarthquakeController;
use App\Http\Controllers\EnrollmentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/token', function () {
    return csrf_token();
});

//Route::post('/file', function (){
//    return 'hey there';
//});
// Route::post('/file', [FileController::class, 'store']);
// Route::post('/search', [FileController::class, 'search']);
// //Route::get('/people', [FileController::class, 'index']);
// Route::put('people/{id}', [FileController::class, 'update']);

// Route::get('/searchView', function (){
//    return view('search');
// });

//Route::get('editView', function (){
//    return view('edit');
//});
// Route::get('/editView', [FileController::class, 'index']);

// Routes for assignment2
//Route::get('/', [EarthquakeController::class, 'getEarthquakeData']);
//Route::get('/dateRangeEarthquakeData', [EarthquakeController::class, 'getDateRangeEarthquakeData']);
//Route::get('/dateRangePlaceEarthquakeData', [EarthquakeController::class, 'dateRangePlaceEarthquakeData']);


//Routes for Assignment3
// Route::get('/', function (){
//     return view('assignment3/assignment3');
// });
//Route::get('/', [EarthquakeController::class, 'getRandomEarthquakeData']);
//// Route::get('/randomEarthquakeData', [EarthquakeController::class, 'getRandomEarthquakeData']);
// Route::get('/filteredEarthquakeDataView', function (){
//     return view('assignment3/filteredEarthquakeData');
// });
// Route::get('/filterEarthquakeData', [EarthquakeController::class, 'getFilteredEarthquakeData']);


//Routes for Quiz3
// Route::get('/', function (){
//     return view('quiz3/quiz3');
// });
// Route::get('/', [EarthquakeController::class, 'getNiDetails']);
//Route::get('/', [EarthquakeController::class, 'getUserDetails']);
//Route::get('/', [EarthquakeController::class, 'getCodeDetails']);


//Routes for Assignment 4
//Route::get('/', function (){
//     return view('assignment4/assignment4');
// });
//Route::get('/getData', [EarthquakeController::class, 'getEarthquakeDataForChart']);


//Routes for Quiz4
//Route::get('/', function(){
//  return view('quiz4/quiz4');
//});

// Route::get('/', [EarthquakeController::class, 'quiz4Point6']);

//Route::get('/', function (){
//    return view('quiz8/quiz8');
//});
Route::get('/', [EnrollmentController::class, 'createClassName']);
Route::get('/addStudent', function (){
    return view('quiz8/addStudent');
});
Route::get('/student', [EnrollmentController::class, 'createStudent']);
Route::get('/getStudents', [EnrollmentController::class, 'getStudents']);
