<x-adminlte-card title="Agregue productos" theme="dark" icon="fas fa-lg fa-bell" collapsible maximizable>
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
                    <th class="table-th text-white">Description</th>
                    <th class="table-th text-white">Stock</th>
                    <th class="table-th text-white">Precio</th>
                    <th class="table-th text-white">Imagen</th>
                    <th class="table-th text-white">Actions</th>
                </tr>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <h6>{{ $product->name }}</h6>
                        </td>
                        <td>
                            <h6>{{ $product->stock }}</h6>
                        </td>
                        <td>
                            <h6>{{ $product->price }}</h6>
                        </td>
                        <td class="text-center">
                            <span>
                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="IMagen de ejemplo"
                                    height="70" width="80" class="rounded">
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Add"
                                wire:click="addProduct({{ $product->id }})"><i class="fa fa-plus"></i></a>


                        </td>


                    </tr>
                @endforeach
            </tbody>
            </thead>

        </table>

    </div>
</x-adminlte-card>

