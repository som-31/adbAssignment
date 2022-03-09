<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        .scrollit {
            overflow:scroll;
            /*height:100px;*/
        }
    </style>
</head>
<body>
<button><a href="/" style="text-decoration: none;">Get Random Earthquake Data</a></button>
<button><a href="/filteredEarthquakeDataView" style="text-decoration: none;">Filtered Earthquake Data</a></button>
     <h1>Fetch Earthquake Data corresponding to Different filters</h1>
     <form action="filterEarthquakeData" method="get">
         <div>
             <label for="location">Location</label>
             <input type="text" name="location" id="location">
         </div>
         <br>
         <div>
             <label for="latitude">Latitude</label>
             <input type="text" name="latitude" id="latitude">
         </div>
         <br>
         <div>
             <label for="longitude">Longitude</label>
             <input type="text" name="longitude" id="longitude">
         </div>
         <br>
         <div>
             <label for='magMinRange'>Magnitude From</label>
             <input type="text" name="magMinRange" id="magMinRange">
         </div>
         <br>
         <div>
             <label for='magMaxRange'>Magnitude To</label>
             <input type="text" name="magMaxRange" id="magMaxRange">
         </div>
         <br>
         <div>
             <label for="dateMinRange">Date From</label>
             <input type="date" name="dateMinRange" id="dateMinRange">
         </div>
         <br>
         <div>
             <label for="dateMaxRange">Date From</label>
             <input type="date" name="dateMaxRange" id="dateMaxRange">
         </div>
         <br>
         <div>
             <input type="submit" value="Fetch Results">
         </div>
     </form>

     @if (isset($records) && count($records) > 0)
         @if(isset($seconds) && $seconds > 0)
             <span>Time Elapsed: {{$seconds}}</span>
         @elseif(isset($startTime) && isset($endTime))
             <span>Time is in milliseconds</span>
             <p> Start Time: {{$startTime}}, End Time: {{$endTime}}</p>
         @endif
         <h2>Earthquake Data for records count {{count($records)}}</h2>
         @if(isset($message))
             <span>{{$message}}</span>
         @endif
         <div>
             <table class="scrollit">
                 <tr>
                     <th>Time</th>
                     <th>Latitude</th>
                     <th>Longitude</th>
                     <th>Magnitude</th>
                     <th>Place</th>
                     <th>Location</th>
                 </tr>
                 @foreach($records as $record)
                     <tr>
                         <td>{{$record['time']}}</td>
                         <td>{{$record['latitude']}}</td>
                         <td>{{$record['longitude']}}</td>
                         <td>{{$record['mag']}}</td>
                         <td>{{$record['place']}}</td>
                         <td>{{$record['locationSource']}}</td>
                     </tr>
                 @endforeach
             </table>
         </div>

     @else
         <span>No records found</span>
     @endif

</body>
</html>
