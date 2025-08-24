<!doctype html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>ToWATCH - Кино</title>
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/app.css") }}">
    <script src="{{ asset("assets/js/color-modes.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
</head>
<body class="d-flex flex-column min-vh-100">
@include("components.header")

<main class="flex-grow-1">
    @yield("content")
</main>




</body>
</html>
