@extends('adminlte::page')
@livewireStyles
@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar Role</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre</p>
            <p class="form-control">{{ $user->name }}</p>

            <h2 class="h5">Listado de roles</h2>
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
            {{ Form::label('Nombre', null, ['class' => 'control-label']) }}
            {{ Form::text('name', $user->name, array_merge(['class' => 'form-control'], [])) }}

            @foreach ($roles as $role)
                <div>
                    <label>
                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
            {!! Form::submit('Asignar Roles', ['class' => 'btn btn-primary mt-2']) !!}
            {!! Form::close() !!}
        </div>
    </div>


@stop
@livewireScripts
