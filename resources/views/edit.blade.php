<!doctype html>
<html lang="\">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<a href="{{ url('/') }}">Upload</a>
<a href="{{ url('/searchView') }}">Search</a>
<a href="{{ url('/editView') }}">Edit</a>
{{--<h1> hey there {{ $name  }}</h1>--}}
<h1>This is Edit page</h1>
{{--Create a Table format for displaying the data and corresponding Edit and delete functionality--}}
<table>
    <thead>
    <tr>
    <th>object</th>
    <th>min</th>
    <th>max</th>
    <th>picture</th>
    <th>charm</th>
    </tr>
    </thead>
    <tr>
        <td>Dhruvi</td>
        <td>TX</td>
        <td>99099</td>
        <td>100</td>
        <td>550</td>
        <td>1000010</td>
        <td>dhru.jpg</td>
        <td>Dhruvi is nice</td>
        <td><button>Edit</button></td>
        <td><button>Delete</button></td>
    </tr>
</table>
</body>
</html>
