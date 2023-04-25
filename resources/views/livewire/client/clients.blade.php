
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-widget">
                <div class="card-header">
                    <h4 class="card-title">
                        <b>{{$componentName}} | {{$pageTitle}}</b>
                    </h4>
                    <div class="card-tools">
                        <ul class="nav nav-pills" class="active">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="bg-dark" data-toggle="modal"
                                    data-target="#theModal">Agregar</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-2">
                @include('common.search-box')
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripe mt-1">
                            <thead class="text-white" style="background:#3b3f5c;">
                                <tr>
                                    <th class="table-th text-white">Cedula</th>
                                    <th class="table-th text-white">Nombre</th>
                                    <th class="table-th text-white">Rif</th>
                                    <th class="table-th text-white">Imagen</th>
                                    <th class="table-th text-white">Email</th>
                                    <th class="table-th text-white">Actions</th>
                                </tr>
                            <tbody>
                                @foreach ($clients as $client)


                                <tr>
                                    <td>
                                        <h6>{{$client->cedula}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$client->nombre}}  {{$client->apellido}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$client->tipo_rif.'-'.$client->rif}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <span>
                                            <img src="{{asset('storage/clients/'.$client->image)}}" alt="IMagen de ejemplo" height="70" width="80"
                                                class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$client->email}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Edit" wire:click="edit({{$client->id}})"><i
                                                class="fa fa-edit"></i></a>

                                        <a href="javascript:void(0)"
                                        onclick="Confirm('{{$client->id}}')"
                                        class="btn btn-dark " title="Delete"><i
                                                class="fa fa-trash"></i></a>

                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                            </thead>
                        </table>
                      {{$clients->links()}}
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.client.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Livewire.on('showModal', msg => {
                $("#theModal").modal('show');
});
Livewire.on('client-added', msg => {
                $("#theModal").modal('hide');
});
Livewire.on('client-updated', msg => {

                $("#theModal").modal('hide');
});
        });

        function Confirm(product_id){

            //const swal = require('sweetalert2');
                Swal.fire({
                    title:'Confirmar ',
                    text:'Confirmas eliminar el registro?',
                    type:'warning',
                    showCancelButton:true,
                    cancelButtonText:'Cerrar',
                    cancelButtonColor: '#fff',
                    confirmButtonColor:'#3B3F5C',
                    confirmButtonText: 'Aceptar',
                    }).then(function (result){
                        if(result.value){
                            Livewire.emit('deletedRow',id)
                            swal.close()
                        }
                    })
            }
    </script>


