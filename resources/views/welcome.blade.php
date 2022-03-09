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
<h1>SOMNATH JADHAV</h1>
<h1>67009</h1>
<img src="woolf.jpg" alt="woolf" width="200px" height="200px">
<br>

  <a href="{{ url('/') }}">Upload</a>
  <a href="{{ url('/searchView') }}">Search</a>
  <a href="{{ url('/editView') }}">Edit</a>
 <h1>This is Upload Page</h1>
  <form action="{{ url('/file') }}" method="post" enctype="multipart/form-data">
  @csrf <!-- {{ csrf_field() }} -->
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <br>
      <input type="submit" value="Upload Image/CSV" name="submit">
  </form>
  @if (isset($message))
      <span>{{ $message }}</span>
  @endif

</body>
</html>
