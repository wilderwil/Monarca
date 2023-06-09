<div wire:ignore.self class="modal fade" id="modalDetails" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    @if ($details)
                        <b>Detalle del credito # {{ $creditId }}: {{ $details[0]->nombre }} -
                            {{ number_format($details[0]->total_amount, 2) }}</b>
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
                            @if ($details)
                                @foreach ($details as $key=>$detalle)

                                    <tr>

                                        <td>
                                            <h6>{{ $key +1 }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $detalle->expiration_date }}</h6>
                                        </td>
                                        <td class="text-right">
                                            <h6>{{ number_format($detalle->amount, 2) }}</h6>
                                        </td>

                                        <td class="text-right">
                                            <h6>{{ number_format($detalle->total, 2) }}</h6>
                                        </td>
                                        <td class="text-right">
                                            <h6>{{ number_format($detalle->amount - $detalle->total, 2) }}</h6>
                                        </td>
                                        <td class="text-right">
                                            @if ($detalle->amount == $detalle->total)
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
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <h5 class="text-center font-weight-bold">Totales</h5>
                                </td>
                                <td class="text-right">
                                    <h6>{{ number_format($sumTotalDetails, 2) }}</h6>
                                </td>
                                <td class="text-right">
                                    <h6>{{ number_format($sumAmountDetails, 2) }}</h6>
                                </td>
                            </tr>
                        </tfoot>
                        </thead>
                    </table>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark close-btn" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>

</div>
