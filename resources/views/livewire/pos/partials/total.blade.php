<div class="pt-3">

    <x-adminlte-card title="Resumen de Venta" theme="dark" icon="fas fa-lg fa-thumbs-upfa-thumbs-up" collapsible  maximizable>
        <div class="task-header">
            <div>
                <h2>Total: ${{number_format($total,2)}}</h2>
                <input type="hidden"  id="hiddenTotal" value="{{$total}}">
            </div>
            <div>
                <h4 class="mt-3">Articulos: {{$itemsQuantity}}</h4>
            </div>
        </div>
    </x-adminlte-card>

</div>
