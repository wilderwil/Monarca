@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de Roles</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('info') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                @can('admin.activities.create')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-secondary btn-sm">
                        <i class="fa fa-plus"></i>
                        Nuevo Rol
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->start_date }}</td>
                            <td>{{ $role->end_date }}</td>

                            <td width="10px">
                                @can('admin.roles.edit')
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-info">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.roles.edit')
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                    </form>
                                @endcan


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
