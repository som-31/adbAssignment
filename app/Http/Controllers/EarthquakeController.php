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
        $count = $request->get('count') ?  intval($request->get('count')) : 0;

        if($count > 0){
            /**
             * Get the data from redis and return the response
             */
//            if($cachedData = Redis::get('count_' . $request->get('count'))){
//                return view('assignment3/assignment3',
//                    ['records' => json_decode($cachedData, true),
//                        'message' => 'Data is being fetched from Redis cache']);
//            }
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
//            Redis::set('count_'.$count, json_encode($records)) ;
            return view('assignment3/assignment3', ['records' => $records,
                'seconds' => $diffInSeconds,
                'startTime' =>$startTime->format('m/d/Y, H:i:s:v'),
                'endTime' =>$endTime->format('m/d/Y, H:i:s:v')]);
        }else{
            return  view('assignment3/assignment3');
        }
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
//        if($cachedData = Redis::get($filteredEarthquakeRedisVariable)){
//            return view('assignment3/filteredEarthquakeData',
//                ['records' => json_decode($cachedData, true),
//                    'message' => 'Data is being fetched from Redis cache']);
//        }
        $query = 'Select * from all_month_1 where ';
        $parameters = [];
        foreach ($request->all() as $key => $eachParameter){
            if($key == 'magMinRange' || $key == 'magMaxRange' || $key == 'dateMinRange' || $key == 'dateMaxRange' || $key == 'q'){
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
//        Redis::set($filteredEarthquakeRedisVariable, json_encode($records));
        return view('assignment3/filteredEarthquakeData', ['records' => $records,
            'seconds' => $diffInSeconds,
            'startTime' =>$startTime->format('m/d/Y, H:i:s:v'),
            'endTime' =>$endTime->format('m/d/Y, H:i:s:v')
            ]);
    }

    public function getNiDetails(Request $request){
        $result = DB::select('Select * from ni where id BETWEEN ? AND ?',
            [$request->get('minRange'), $request->get('maxRange')]);
        $records = json_decode(json_encode($result), true);
        $maxRecord = DB::select('Select * from ni where id =
                       (SELECT MAX(id) from ni where id between ? and ?)',
            [$request->get('minRange'), $request->get('maxRange')]);
        $maxRecord = json_decode(json_encode($maxRecord), true);
        $minRecord = DB::select('Select * from ni where id =
                       (SELECT MIN(id) from ni where id between ? and ?)',
            [$request->get('minRange'), $request->get('maxRange')]);
        $minRecord = json_decode(json_encode($minRecord), true);
        return view('quiz3/quiz3', ['records' => $records,
            'maxRecord' => $maxRecord, 'minRecord' => $minRecord]);
    }

    public function getUserDetails(Request $request){
        echo $request->get('id');
        $result = DB::select('Select ni.id, ni.name, di.pwd, di.code from ni,di
    where ni.id = di.id AND ni.id between ? AND ?',
            [$request->get('minRange'), $request->get('maxRange')]);
        $UserRecords = json_decode(json_encode($result), true);
        return view('quiz3/quiz3', ['userRecords' => $UserRecords]);
    }

    public function getCodeDetails(Request $request){
        echo $request->get('code');
        echo $request->get('no');
        $result = DB::select('Select TOP(5) ni.id, ni.name, di.pwd, di.code from ni,di
    where ni.id = di.id AND ni.id = ? AND pi.code = ',
            [$request->get('minRange'), $request->get('maxRange')]);
        $UserRecords = json_decode(json_encode($result), true);
        return view('quiz3/quiz3', ['userRecords' => $UserRecords]);
    }


    public function getEarthquakeDataForChart(Request $request){
        $query= 'Select mag = '."'less than 1'".', COUNT(*) as count
                FROM all_month_1
                WHERE mag < 1
                UNION
                Select mag = '."'1 to 2'".', COUNT(*) as count
                FROM all_month_1
                WHERE mag BETWEEN 1 AND 2
                UNION
                Select mag = '."'2 to 3'".', COUNT(*) as count
                FROM all_month_1
                WHERE mag BETWEEN 2 AND 3
                UNION
                Select mag = '."'up to 5'".', COUNT(*) as count
                FROM all_month_1
                WHERE mag BETWEEN 3 AND 5';
        $result = DB::select($query);
        $result = json_decode(json_encode($result), true);
        return json_encode($result);
    }

    public function quiz4Point6(Request $request){

        print_r($request->all());
        $result = DB::select();
        $UserRecords = json_decode(json_encode($result), true);
        return view('quiz4/quiz4');
    }

}
