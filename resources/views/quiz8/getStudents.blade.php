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
<button><a href="/" style="text-decoration: none;">Add Class</a></button>
<button><a href="/addStudent" style="text-decoration: none;">Add Student to a class</a></button>
<button><a href="/getStudents" style="text-decoration: none;">Get Students for a class</a></button>
<button><a href="/removeStudent" style="text-decoration: none;">Remove Students for a class</a></button>

<h1>Student Name: Somnath Jadhav</h1>
<h1>Student Id: 1001967009</h1>


{{--<h1>Fetch Earthquake data</h1>--}}
<form action="/getStudents" method="get">
    <label>Enter Class Name</label>
    <input type="text" name="className" id="className">
{{--    <input type="number" name="count" id="count">--}}
    <input type="submit" value="Fetch Students">
</form>
@if (isset($records) && count($records) > 0)
{{--    @if(isset($seconds) && $seconds > 0)--}}
{{--        <span>Time Elapsed: {{$seconds}}</span>--}}
{{--    @elseif(isset($startTime) && isset($endTime))--}}
{{--        <span>Time is in milliseconds</span>--}}
{{--        <p> Start Time: {{$startTime}}, End Time: {{$endTime}}</p>--}}
{{--    @endif--}}
    @if(isset($message))
        <span>{{$message}}</span>
    @endif
    <h2>Students Data for records count {{count($records)}}</h2>
    <div>
        <table class="scrollit">
            <tr>
                <th>Class Name</th>
                <th>Student ID</th>
{{--                <th>Longitude</th>--}}
{{--                <th>Magnitude</th>--}}
{{--                <th>Place</th>--}}
            </tr>
            @foreach($records as $record)
                <tr>
                    <td>{{$record['class_name']}}</td>
                    <td>{{$record['student_id']}}</td>
{{--                    <td>{{$record['longitude']}}</td>--}}
{{--                    <td>{{$record['mag']}}</td>--}}
{{--                    <td>{{$record['place']}}</td>--}}
                </tr>
            @endforeach
        </table>
    </div>

@else
    <span>No records found</span>
@endif

</body>
</html>
