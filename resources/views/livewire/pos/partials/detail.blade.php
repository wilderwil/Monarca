<div class="pt-3">

    <x-adminlte-card title="Detalle de Productos" theme="dark" icon="fas fa-lg fa-thumbs-upfa-thumbs-up" collapsible  maximizable>
        @if ($total>0)


        <div class="table-responsive tblscroll" style="max-height: 650px; overflow:hidden">
        <table class="table table-bordered table-striped mt-1">
        <thead class="text-white" style="background: #3b3f5c">
          <tr>
              <th width="10%"></th>
              <th class="table-th text-left text-white">Descripcion</th>
              <th class="table-th text-left text-white">Precio</th>
              <th class="table-th text-left text-white">Precio Descuento</th>
              <th width="13%" class="table-th text-left text-white">Cantidad</th>
              <th class="table-th text-left text-white">Importe</th>
              <th class="table-th text-left text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ( $cart as $item )


            <tr>
                <td class="text-center">
                    @if(count($item->attributes)> 0)
                    <span>
                        <img src="{{ asset('storage/products/'.$item->attributes[0])}}" alt="imagen de producto"
                        class="rounded" width="90" height="90">
                    </span>
                    @endif
                </td>
                <td><h6>{{$item->name}}</h6></td>
                <td class="text-center">${{number_format($item->price,2)}}</td>
                <td>
                    <input type="number" id="price_{{$item->id}}"
                    wire:change="updatePrice({{$item->id}},$('#r-'+{{$item->id}}).val(),$('#price_'+{{$item->id}}).val())"
                    style="font-size: 1rem!important"
                    class="form-control text-center"
                    value="{{$item->price}}">
                </td>

                <td>
                    <input type="number" id="r-{{$item->id}}"
                    wire:change="updateQty({{$item->id}},$('#r-'+{{$item->id}}).val())"
                    style="font-size: 1rem!important"
                    class="form-control text-center"
                    value="{{$item->quantity}}">
                </td>
                <td class="text-center">
                    <h6>
                        ${{number_format($item->price * $item->quantity,2)}}
                    </h6>
                </td>
                <td class="text-center">
                    <button onclick="Confirm('{{$item->id}}','removeItem','Confirmas que deseas eliminar el producto de la compra?')" class="btn btn-dark mbmobile">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button wire:click.prevent="decreaseQty({{$item->id}})" class="btn btn-dark mbmobile">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button wire:click.prevent="increaseQty({{$item->id}})" class="btn btn-dark mbmobile">
                        <i class="fas fa-plus"></i>
                    </button>

                </td>
            </tr>
            @endforeach
        </tbody>

      </table>
    </div>
    @else
        <h5 class="text-center text-muted">Agregar productos a la venta</h5>
    @endif
    <div wire:loading.inline wire:target="saveSale">
        <h4 class="text-danger text-center">Guardando la venta...</h4>
    </div>
    </x-adminlte-card>

</div>
