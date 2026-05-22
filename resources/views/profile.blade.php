@extends('components.app')



@section('content')
    @livewire('user.profile',['value'=>$value])
@endsection
