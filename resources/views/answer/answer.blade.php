<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Answer</title>
</head>
<body>
    @foreach ($answers as $key=>$answer)
        <h1> {{$answer->isi}} </h1>
    @endforeach
</body>
</html>