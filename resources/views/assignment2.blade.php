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
    </style>
</head>
<body>
<h1>Name: Somnath Jadhav</h1>
<h1>Student Id: 1001967009</h1>
<button><a href="/" style="text-decoration: none;">Home</a></button>
<button><a href="/dateRangeEarthquakeData" style="text-decoration: none;">Date Range Earthquake Data</a></button>
  <h1>Search for Magnitude of Earthquakes and get the count</h1>
  <form action="/" method="get">
      <input type="text" name="mag" id="mag">
      <input type="submit" value="Fetch Results">
  </form>
@if(isset($count) && $count > 0)
    <span>Count of records are {{$count}}</span>
@else
    <span>No records are found</span>
@endif

<h1>Code for 12 point starts here</h1>
<h1>Fetch Earthquake Data corresponding to Different Magnitude ranges</h1>
<form action="dateRangeEarthquakeData" method="get">
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
        <label for="place">Enter Place</label>
        <input type="text" name="place" id="place">
    </div>
{{--    <div>--}}
{{--        <label for="dateMinRange">Date From</label>--}}
{{--        <input type="date" name="dateMinRange" id="dateMinRange">--}}
{{--    </div>--}}
{{--    <br>--}}
{{--    <div>--}}
{{--        <label for="dateMaxRange">Date From</label>--}}
{{--        <input type="date" name="dateMaxRange" id="dateMaxRange">--}}
{{--    </div>--}}
    <br>
    <div>
        <input type="submit" value="Fetch Results">
    </div>
</form>
@if (isset($records) && $count > 0)
    <h2>Earthquake Data for records count {{$count}}</h2>
    <div>
        <table class="scrollit">
            <tr>
                <th>Time</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Magnitude</th>
                <th>Place</th>
            </tr>
            @foreach($records as $record)
                <tr>
                    <td>{{$record['time']}}</td>
                    <td>{{$record['latitude']}}</td>
                    <td>{{$record['longitude']}}</td>
                    <td>{{$record['mag']}}</td>
                    <td>{{$record['place']}}</td>
                </tr>
            @endforeach
        </table>
    </div>

@else
    <span>No records found</span>
@endif
</body>
</html>
