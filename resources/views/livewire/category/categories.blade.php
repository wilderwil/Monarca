
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
                                    <th class="table-th text-white">Description</th>
                                    <th class="table-th text-white">Imagen</th>
                                    <th class="table-th text-white">Actions</th>
                                </tr>
                            <tbody>
                                @foreach ($categories as $category)


                                <tr>
                                    <td>
                                        <h6>{{$category->name}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <span>
                                            <img src="{{asset('storage/categories/'.$category->image)}}" alt="IMagen de ejemplo" height="70" width="80"
                                                class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Edit" wire:click="edit({{$category->id}})"><i
                                                class="fa fa-edit"></i></a>
                                             @if($category->products->count() < 1)
                                        <a href="javascript:void(0)"
                                        onclick="Confirm('{{$category->id}}')"
                                        class="btn btn-dark " title="Delete"><i
                                                class="fa fa-trash"></i></a>
                                            @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            </thead>
                        </table>
                      {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.category.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Livewire.on('showModal', msg => {
                $("#theModal").modal('show');
});
Livewire.on('category-added', msg => {
                $("#theModal").modal('hide');
});
Livewire.on('category-updated', msg => {
                $("#theModal").modal('hide');
});
        });

        function Confirm(category_id){

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


