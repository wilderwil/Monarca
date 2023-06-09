@extends('adminlte::page')
@livewireStyles
@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de Usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')


@stop
@livewireScripts
