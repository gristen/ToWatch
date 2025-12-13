<!doctype html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>ToWATCH - @yield('title', 'Кино')</title>
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/app.css") }}">
    <script src="{{ asset("assets/js/color-modes.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
@include("components.header")

<main class=" container flex-grow-1">
    {{--TODO --}}
   {{-- <audio id="backgroundAudio" loop muted>
        <source src="{{ asset('assets/pepsikow.ogg') }}" type="audio/mpeg">
    </audio>--}}


    @yield("content")
</main>


{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}
{{--        const audio = document.getElementById('backgroundAudio');--}}

{{--        // Разблокируем автоплей после первого клика пользователя--}}
{{--        document.body.addEventListener('click', function() {--}}

{{--            console.log("123");--}}
{{--            audio.play().then(() => {--}}
{{--                audio.muted = false; // Включаем звук после начала воспроизведения--}}
{{--            });--}}
{{--        }, { once: true }); // Срабатывает только один раз--}}
{{--    });--}}
{{--</script>--}}

</body>
</html>
