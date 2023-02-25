<div>
    <div class="card">
        <div class="card-header">
            <input class="form-control" placeholder="Ingrese Nombre o Correo de un Usuario" wire:model="search">


        </div>
        @if ($users->count())


            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>email</th>

                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td width="10px">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-info">Editar</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>
                    No Hay registros con ese criterio de busqueda
                </strong>
            </div>

        @endif
    </div>

</div>
