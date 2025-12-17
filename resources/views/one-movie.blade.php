@extends('components.app')
@section('content')

    <div class="one-movie__hero full-width"  style="background: url({{$movie->preview_url}}) no-repeat right -20px top 0;
            background-size: 40%;">
        <div class="container h-100">
            <div class="row h-100 align-items-center" >
                <div class=" one-movie__content" >
                    <h1>{{$movie->name}}</h1>

                    <p>
                        Оценка
                        <span class="badge bg-warning warn__badge"></span>
                    </p>

                    <p class="text-white col-8">
                       {{$movie->shortDescription}}
                    </p>

                    <small class="text-secondary">Добавлен 24/12/2023</small>
                </div>
            </div>
        </div>
    </div>





@endsection
