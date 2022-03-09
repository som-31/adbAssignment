<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="{{ url('/') }}">Upload</a>
<a href="{{ url('/searchView') }}">Search</a>
<a href="{{ url('/editView') }}">Edit</a>

  <h1>This is search Page</h1>
<form action="{{ url('/search') }}" method="post">
@csrf <!-- {{ csrf_field() }} -->
    <div>
    <label for="name">Enter Name</label>
    <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="greaterThan">Greater Than</label>
        <input type="number" name="greaterThan" id="greaterThan">
    </div>
    <div>
        <label for="lessThan">less Than</label>
        <input type="number" name="lessThan" id="lessThan">
    </div>
    <input type="submit" value="Submit">
</form>

@if(isset($contents))
    <img src="data:image/jpg;base64,{{ $contents }}" width="100px" height="100px"/>
@endif
</body>
</html>
