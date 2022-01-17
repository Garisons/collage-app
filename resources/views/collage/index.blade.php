<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/css/app.css" rel="stylesheet">
    <title>Collage</title>
</head>
<body>
@foreach ($images as $image)<img src="{{ Storage::url($image) }}">@endforeach
</body>
</html>
