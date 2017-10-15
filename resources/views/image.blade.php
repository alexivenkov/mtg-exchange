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
<h1>Image preview</h1>

@if(isset($image_name))
    <img src="{{ asset('storage/test/' . $image_name) }}" alt="картинка">
@else
    <p>Pls provide an image name with get param 'image_name'</p>
@endif
</body>
</html>