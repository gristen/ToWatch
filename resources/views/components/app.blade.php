<!doctype html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/app.css")}}">
    <script src="{{asset("assets/js/color-modes.js")}}"></script>
</head>

    <body class="d-flex flex-column min-vh-100">
    @include("/components.header")
    @yield("content")

    </body>
</html>
