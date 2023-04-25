<div wire:ignore.self class="modal fade" id="modalInstallmentsDetails" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    @if ($installmentDetail)
                        <b>Pago de la cuota # {{ $numInstallments['row_number'] }}
                    @endif

            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-stripe mt-1">
                        <thead class="text-white" style="background:#3b3f5c;">
                            <tr>
                                <th class="table-th text-white text-center">Numero de cuota</th>
                                <th class="table-th text-white text-center">Fecha vencimiento</th>
                                <th class="table-th text-white text-center">Monto cuota</th>
                                <th class="table-th text-white text-center">Pagado</th>
                                <th class="table-th text-white text-center">Pendiente</th>
                                <th class="table-th text-white text-center">Status</th>

                            </tr>
                        <tbody>
                            @if ($installmentDetail)
                                @foreach ($installmentDetail as $key => $detalle)
                                    <tr>

                                        <td>
                                            <h6>{{ $numInstallments['row_number'] }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $detalle->expiration_date }}</h6>
                                        </td>
                                        <td class="text-right">
                                            <h6>{{ number_format($detalle->amount, 2) }}</h6>
                                        </td>

                                        <td class="text-right">
                                            <h6>{{ number_format($totalInstallment, 2) }}</h6>
                                        </td>
                                        <td class="text-right">
                                            <h6>{{ number_format($detalle->amount - $totalInstallment, 2) }}</h6>
                                        </td>
                                        <td class="text-right">
                                            @if ($detalle->amount == $totalInstallment)
                                                <span class="right badge badge-success">pagada</span>
                                            @elseif($detalle->expiration_date < now())
                                                <span class="right badge badge-danger">vencida</span>
                                            @else
                                                <span class="right badge badge-primary">pendiente</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>

                        </thead>
                    </table>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-center font-weight-bold">Pagar</h5>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('montoPago', 'Monto a pagar') !!}
                            {!! Form::number('montoPago', $this->montoPago, [
                                'wire:model.lazy' => 'montoPago',
                                'class' => 'form-control',
                                'placeholder' => 'Ingrese el monto a pagar',
                            ]) !!}
                            @error('montoPago')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <x-adminlte-button wire:click.prevent="savePayment()" class="btn-flat" type="submit" label="Guardar" theme="success" icon="fas fa-lg fa-save"/>

                <button type="button" wire:click="$refresh" class="btn btn-dark close-btn" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>

</div>
