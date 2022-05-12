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
<form action="/student" method="get">
        <div>
            <label>Enter Class Name</label>
            <input type="text" name="className" id="className">
        </div>
        <div>
            <label>Enter Student ID</label>
            <input type="number" name="studentId" id="studentId">
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
</form>
</body>
</html>
