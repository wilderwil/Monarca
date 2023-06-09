<x-adminlte-card title="Seleccione Cliente" theme="dark" icon="fas fa-lg fa-bell" collapsible maximizable>
    <div class="row justify-content-between ">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text input-gp">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input class="form-control" type="text" wire:model="search" placeholder="Buscar ">

            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-stripe mt-1">
            <thead class="text-white" style="background:#bdbdc0;">
                <tr>
                    <th class="table-th text-white">cedula</th>
                    <th class="table-th text-white">Nombre</th>
                    <th class="table-th text-white">Email</th>

                </tr>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>
                            <h6>{{ $client->cedula }}</h6>
                        </td>
                        <td>
                            <h6>{{ $client->nombre ." ". $client->apellido }}</h6>
                        </td>
                        <td>
                            <h6>{{ $client->email }}</h6>
                        </td>


                        <td class="text-center">
                            <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Add"
                                wire:click="addClient({{ $client->id }})"><i class="fa fa-plus"></i></a>


                        </td>


                    </tr>
                @endforeach
            </tbody>
            </thead>

        </table>

    </div>
</x-adminlte-card>

