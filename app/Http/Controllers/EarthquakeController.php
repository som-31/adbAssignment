<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class EarthquakeController extends Controller
{
    /**
     * Get Earthquake data
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEarthquakeData(Request $request)
    {
            $result = DB::select('Select * from all_month where mag >= ?',
                [$request->get('mag')]);
            $records = json_decode(json_encode($result), true);
            return view('assignment2', ['count' => count($records)]);
    }

    public function getDateRangeEarthquakeData(Request $request){
        $result = DB::select('Select * from all_month where mag BETWEEN ? AND ?
                                   AND time BETWEEN ? AND ?',
            [$request->get('magMinRange'),
                $request->get('magMaxRange'),
                $request->get('dateMinRange'),
                $request->get('dateMaxRange')]);
        $records = json_decode(json_encode($result), true);
        $count = count($records);
        return view('dateRangeEarthquakeData', ['records' => $records, 'count' => $count]);
    }

    public function dateRangePlaceEarthquakeData(Request $request){
//        echo $request->get('magMinRange');
//             echo $request->get('magMaxRange');
//        echo $request->get('place');
////        die('in here');
        $magMinRange = (float)$request->get('magMinRange');
        $magMaxRange = (float)$request->get('magMaxRange');
        $result = DB::select('Select * from quiz2Data where mag BETWEEN ? AND ? AND place LIKE '."'%?%'",
            [ $magMinRange, $magMaxRange, $request->get('place')]);
        var_dump($result);
        $records = json_decode(json_encode($result), true);
        $count = count($records);
        print_r($records);
        return view('assignment2');
    }

    //   Methods for Assignments starts from below

    /**
     * get random earthquake data upto 1000 records
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getRandomEarthquakeData(Request $request){
        $count = intval($request->get('count'));

        /**
         * Get the data from redis and return the response
         */
        if($cachedData = Redis::get('count_' . $request->get('count'))){
            return view('assignment3/assignment3',
                ['records' => json_decode($cachedData, true),
                    'message' => 'Data is being fetched from Redis cache']);
        }
        /**
         * condition to enforce 1000 records
         */
//        if($count > 1000){
//            $count = 1000;
//        }
        $startTime = new \DateTime("now");

//        echo $startTime->format('m/d/Y, H:i:s:v');
        $result = DB::select('Select Top(?) * from all_month_1',
            [$count]);
        $records = json_decode(json_encode($result), true);
        $endTime = new \DateTime("now");
//        echo ' '.$endTime->format('m/d/Y, H:i:s:v');
        $interval = $startTime->diff($endTime);
        $diffInSeconds = $interval->s;
        Redis::set('count_'.$count, json_encode($records)) ;
        return view('assignment3/assignment3', ['records' => $records,
            'seconds' => $diffInSeconds,
            'startTime' =>$startTime->format('m/d/Y, H:i:s:v'),
            'endTime' =>$endTime->format('m/d/Y, H:i:s:v')]);
    }


    /**
     * Get Filtered Data corresponding to where clause
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getFilteredEarthquakeData(Request $request){
        $mapping = [
            'location' => 'locationSource',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'magMinRange' => 'mag',
            'magMaxRange' => 'mag',
            'dateMinRange' => 'time',
            'dateMaxRange' => 'time'
        ];
        $filteredEarthquakeRedisVariable = 'earthquake';
        foreach ($request->all() as $key => $eachParameter){
            if($key && $eachParameter){
                $filteredEarthquakeRedisVariable = $filteredEarthquakeRedisVariable."_".$key."_".$eachParameter;
            }
        }
        /**
         * Get the data from redis and return the response
         */
        if($cachedData = Redis::get($filteredEarthquakeRedisVariable)){
            return view('assignment3/filteredEarthquakeData',
                ['records' => json_decode($cachedData, true),
                    'message' => 'Data is being fetched from Redis cache']);
        }
        $query = 'Select * from all_month_1 where ';
        $parameters = [];
        foreach ($request->all() as $key => $eachParameter){
            if($key == 'magMinRange' || $key == 'magMaxRange' || $key == 'dateMinRange' || $key == 'dateMaxRange'){
                continue;
            }
            if($key && $eachParameter){
                $query = $query." $mapping[$key] = ? AND";
                array_push($parameters, $eachParameter);
            }
        }
        if($request->get('magMinRange')  && $request->get('magMaxRange')){
            $query = $query." mag BETWEEN ? and ? AND";
            array_push($parameters,$request->get('magMinRange'), $request->get('magMaxRange'));
        }
        if($request->get('dateMinRange')  && $request->get('dateMaxRange')){
            $query = $query." time BETWEEN ? and ? AND";
            array_push($parameters,$request->get('dateMinRange'), $request->get('dateMaxRange'));
        }
        $queryLength = strlen($query);
        $query = substr_replace($query, '',$queryLength - 3 , $queryLength);
        $startTime = new \DateTime("now");

//        echo $startTime->format('m/d/Y, H:i:s:v');

        $result = DB::select($query, $parameters);
        $records = json_decode(json_encode($result), true);
        $endTime = new \DateTime("now");
//        echo ' '.$endTime->format('m/d/Y, H:i:s:v');
        $interval = $startTime->diff($endTime);
        $diffInSeconds = $interval->s;
        Redis::set($filteredEarthquakeRedisVariable, json_encode($records));
        return view('assignment3/filteredEarthquakeData', ['records' => $records,
            'seconds' => $diffInSeconds,
            'startTime' =>$startTime->format('m/d/Y, H:i:s:v'),
            'endTime' =>$endTime->format('m/d/Y, H:i:s:v')
            ]);
    }


}
