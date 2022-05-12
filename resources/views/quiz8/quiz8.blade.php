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
<button><a href="/" style="text-decoration: none;">Add Class</a></button>
<button><a href="/addStudent" style="text-decoration: none;">Add Student to a class</a></button>
<button><a href="/getStudents" style="text-decoration: none;">Get Students for a class</a></button>
<button><a href="/removeStudent" style="text-decoration: none;">Remove Students for a class</a></button>
 <h1>Student Name: Somnath Jadhav</h1>
<h1>Student ID: 1001967009</h1>
{{-- <form action="" method="post"></form>--}}

<form method="get" action="{{ url('/') }}">
    <div>
        <label>Enter Class Name</label>
        <input type="text" name="className" id="className">
    </div>
    <div>
        <label>Enter Enrollment Limit</label>
        <input type="number" name="limit" id="limit">
    </div>
<div>
    <input type="submit" value="Submit">
</div>
</form>
</body>
</html>
