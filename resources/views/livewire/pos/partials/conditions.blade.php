<div class="pt-3">

    <x-adminlte-card title="Forma de Pago" theme="dark" icon="fas fa-lg fa-thumbs-upfa-thumbs-up" collapsible
        maximizable>
        <div class="task-header">
            @if($client)
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img src="{{asset('storage/clients/'.$client_image)}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                {{$client_rif}} : {{$client_name}}
                </div>
                </div>
                @endif
            <div class="row">



                <div class="col-sm-3 ">

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" value="contado"
                                wire:model="tipo_venta">
                            <label class="form-check-label">Contado</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" checked="" value="crédito"
                                wire:model="tipo_venta">
                            <label class="form-check-label">Crédito</label>
                        </div>

                    </div>

                </div>
                <div class="col-sm-9 ">
                    <div class="row">
                    @if ($tipo_venta == 'crédito')
                        <div class="col-sm-4">
                            <x-adminlte-input wire:model="inicial" name="inicial" label="Inicial" placeholder="Monto Inicial" label-class="text-dark" igroup-size="sm">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        $
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-sm-4 ">
                            <x-adminlte-select wire:model="cuotas" name="cuotas" label="Cuotas"
                                label-class="text-dark" igroup-size="sm">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text ">
                                        <i class="fas fa-check text-dark"></i>
                                    </div>
                                </x-slot>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                            </x-adminlte-select>
                        </div>
                        <div class="col-sm-4 ">
                            <x-adminlte-select wire:model="periodo" name="periodo" label="Período"
                                label-class="text-dark" igroup-size="sm">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text ">
                                        <i class="fas fa-check text-dark"></i>
                                    </div>
                                </x-slot>
                                <option value ="diario">Diario</option>
                                <option value ="semanal">Semanal</option>
                                <option value ="quincenal">Quincenal</option>
                                <option value ="mensual">Mensual</option>
                            </x-adminlte-select>

                        </div>
                    @endif
                </div>
                </div>
            </div>
            <div class="row">
                <x-adminlte-button wire:click.prevent="saveSale()" class="btn-flat" type="submit" label="Guardar" theme="success" icon="fas fa-lg fa-save"/>

            </div>
            <div class="row">
                <a class="btn btn-primary" target="_blank" href="/download-pdf/123">Download</a>

            </div>
            <div>

            </div>
        </div>
    </x-adminlte-card>

</div>
