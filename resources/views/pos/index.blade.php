@extends('adminlte::page')
@livewireStyles
@section('title', 'Dashboard')



@section('content')
@livewire('pos.search-client')
    @livewire('pos.search')
    @livewire('pos.pos')

@stop
@livewireScripts
