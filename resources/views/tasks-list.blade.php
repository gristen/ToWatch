@extends('components.app')
@section('content')

    @livewire('task-list',['type'=>$type])

@endsection
