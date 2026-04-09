@extends("components.admin.app")

@section("content")
    {{ session('success') }}



    @livewire('tasks.index')

@endsection
