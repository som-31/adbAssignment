<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\EarthquakeController;
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
Route::post('/file', [FileController::class, 'store']);
Route::post('/search', [FileController::class, 'search']);
//Route::get('/people', [FileController::class, 'index']);
Route::put('people/{id}', [FileController::class, 'update']);

Route::get('/searchView', function (){
   return view('search');
});

//Route::get('editView', function (){
//    return view('edit');
//});
Route::get('/editView', [FileController::class, 'index']);

// Routes for assignment2
//Route::get('/', [EarthquakeController::class, 'getEarthquakeData']);
Route::get('/dateRangeEarthquakeData', [EarthquakeController::class, 'getDateRangeEarthquakeData']);
Route::get('/dateRangePlaceEarthquakeData', [EarthquakeController::class, 'dateRangePlaceEarthquakeData']);


//Routes for Assignment3
Route::get('/', function (){
    return view('assignment3/assignment3');
});
Route::get('/randomEarthquakeData', [EarthquakeController::class, 'getRandomEarthquakeData']);
Route::get('/filteredEarthquakeDataView', function (){
    return view('assignment3/filteredEarthquakeData');
});
Route::get('/filterEarthquakeData', [EarthquakeController::class, 'getFilteredEarthquakeData']);
