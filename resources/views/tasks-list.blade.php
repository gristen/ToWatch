@extends('components.app')
@section('content')

    @livewire('tasks.taskList',['type'=>$type])

@endsection
