@extends('components.app')
@section('content')

    <div class="one-movie__hero full-width" style=" background: url({{$movie->preview_url}}) no-repeat right; background-size: 50%;">
        <div class="container h-100">
            <div class="row h-100 align-items-center" >
                <div class=" one-movie__content" >
                    <h1>{{$movie->name}}</h1>

                    <p>
                        Оценка
                        <span class="badge bg-warning warn__badge"></span>
                    </p>

                    <p>
                        Действие сериала разворачивается в мире, где существуют супергерои...
                    </p>

                    <small class="text-secondary">Добавлен 24/12/2023</small>
                </div>
            </div>
        </div>
    </div>



@endsection
