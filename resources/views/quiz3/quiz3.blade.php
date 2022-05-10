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
<h1>
    Student Id: 1001967009
    Name: Somnath Jadhav
</h1>
  <h1>IN quiz 3 </h1>
{{--<form action="/" method="get">--}}
{{--    <div>--}}
{{--        <label for="minRange">Enter Min range</label>--}}
{{--        <input type="text" name="minRange" id="minRange">--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <label for="maxRange">Enter Min range</label>--}}
{{--        <input type="text" name="maxRange" id="maxRange">--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <input type="submit" value="Fetch Results">--}}
{{--    </div>--}}

    @if (isset($maxRecord) && isset($minRecord))
        <div>
            <table class="scrollit">
                <tr>
                    <th>Name</th>
                    <th>Id</th>
                </tr>
                @foreach($maxRecord as $record)
                    <tr>
                        <td>{{$record['name']}}</td>
                        <td>{{$record['id']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    @else
        <span>No records found</span>
    @endif

    @if (isset($maxRecord) && isset($minRecord))
        <div>
            <table class="scrollit">
                <tr>
                    <th>Name</th>
                    <th>Id</th>
                </tr>
                @foreach($minRecord as $record)
                    <tr>
                        <td>{{$record['name']}}</td>
                        <td>{{$record['id']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    @else
        <span>No records found</span>
    @endif

    @if (isset($records) && count($records) > 0)
        <h2>Data for records count {{count($records)}}</h2>
        <div>
            <table class="scrollit">
                <tr>
                    <th>Name</th>
                    <th>Id</th>
                </tr>
                @foreach($records as $record)
                    <tr>
                        <td>{{$record['name']}}</td>
                        <td>{{$record['id']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    @else
        <span>No records found</span>
    @endif



</form>

{{--<form action="/" method="get">--}}
{{--    <div>--}}
{{--        <label for="minRange">Enter Min range</label>--}}
{{--        <input type="text" name="minRange" id="minRange">--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <label for="maxRange">Enter Min range</label>--}}
{{--        <input type="text" name="maxRange" id="maxRange">--}}
{{--    </div>--}}
{{--    <input type="submit" value="Get User data">--}}
{{--</form>--}}

@if (isset($userRecords))
    <div>
        <table class="scrollit">
            <tr>
                <th>Name</th>
                <th>Id</th>
                <th>Code</th>
                <th>pwd</th>
            </tr>
            @foreach($userRecords as $record)
                <tr>
                    <td>{{$record['name']}}</td>
                    <td>{{$record['id']}}</td>
                    <td>{{$record['code']}}</td>
                    <td>{{$record['pwd']}}</td>
                </tr>
            @endforeach
        </table>
    </div>

@else
    <span>No records found</span>
@endif


        <form action="/" method="get">
            <div>
                <label for="no">Enter No</label>
                <input type="text" name="no" id="no">
            </div>
            <div>
                <label for="code">Enter code</label>
                <input type="text" name="code" id="code">
            </div>
            <input type="submit" value="Get User data">
        </form>


</body>
</html>
