<div class="pt-3">
 <x-adminlte-card title="Resumen de Venta" theme="dark" icon="fas fa-lg fa-thumbs-upfa-thumbs-up" collapsible  maximizable>
        <div class="task-header">
            <div class="row">
                <div class="col-md-6">
            <div>
                <h2>Total: ${{number_format($total,2)}}</h2>
                <input type="hidden"  id="hiddenTotal" value="{{$total}}">
            </div>
            <div>
                <h4 class="mt-3">Articulos: {{$itemsQuantity}}</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('fecha', 'Fecha') !!}
                {!! Form::date('fecha', $this->fecha, [
                    'wire:model' => 'fecha',
                    'class' => 'form-control',
                    'placeholder' => 'Fecha',
                ]) !!}
                @error('fecha')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        </div>
        </div>
    </x-adminlte-card>
</div>
