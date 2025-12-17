@extends("components.app")

@section("content")

    <div class="container py-4" id="container">

        @if(Auth::check() && Auth::user()->role_id<3)
            <p class="alert alert-danger text-center"> <i class="bi bi-exclamation-triangle"></i> Ты зашел с расширенными правами доступа. Уровень доступа - {{Auth::user()->role->name}} <i class="bi bi-exclamation-triangle"></i></p>
        @endif


            @livewire('movie.movie-list')

    </div>
@endsection
