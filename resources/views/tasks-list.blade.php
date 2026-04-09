@extends('components.admin.app')
@section('content')

    @livewire('tasks.taskList', ['type' => $type])

@endsection
