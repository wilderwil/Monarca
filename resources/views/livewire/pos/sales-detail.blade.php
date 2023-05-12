<div wire:ignore.self class="modal fade" id="modalDetails" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>Detalle de la venta # {{$saleId}}</b>

            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-stripe mt-1">
                        <thead class="text-white" style="background:#3b3f5c;">
                            <tr>
                                <th class="table-th text-white text-center">Numero</th>
                                <th class="table-th text-white text-center">Producto</th>
                                <th class="table-th text-white text-center">Precio</th>
                                <th class="table-th text-white text-center">Cantidad</th>
                                <th class="table-th text-white text-center">Importe</th>
                            </tr>
                        <tbody>
                            @foreach($details as $detalle)
                            <tr>
                                <td class="text-center">
                                    <h6>{{$detalle->id}}</h6>
                                </td>
                                <td>
                                    <h6>{{$detalle->name}}</h6>
                                </td>
                                <td class="text-right">
                                    <h6>{{number_format($detalle->price,2)}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$detalle->quantity}}</h6>
                                </td>
                                <td class="text-right">
                                    <h6>{{number_format($detalle->quantity * $detalle->price,2)}}</h6>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <h5 class="text-center font-weight-bold">Totales</h5>
                                </td>
                                <td>
                                    <h5 class="text-center">{{$countDetails}}</h5>
                                </td>
                                <td class="text-right">
                                    <h5 >{{number_format($sumDetails,2)}}</h5>
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
