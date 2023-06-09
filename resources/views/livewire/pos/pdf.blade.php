<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
            <h5 class="modal-title text-white">
                @if ($creditDetails)
                    <b>Nombre del cliente: {{ $creditDetails[0]->nombre }}              <br />Cedula: {{ $creditDetails[0]->cedula }}</b>
                    <br/>Telefono: {{ $creditDetails[0]->cel }}
                    <br />Fecha: {{$sale->date}}
                    <br>Tipo: {{$sale->tipo}}
                       @endif
            </h5>

            <div class="table-responsive">
                <table class="table table-bordered table-stripe mt-1">
                    <thead class="text-white" style="background:#3b3f5c;">
                        <tr>
                            <th class="table-th text-white text-center">Id de Producto</th>
                            <th class="table-th text-white text-center">Nombre de Producto</th>
                            <th class="table-th text-white text-center">Precio de Venta</th>


                        </tr>
                    <tbody>
                        @if ($saleDetails)
            @foreach ($saleDetails as $key=>$detalle)

                                <tr>


                                    <td style="padding:0.3rem;" >
                                        {{ $detalle->product_id }}
                                    </td>
                                    <td style="padding:0.3rem;" class="text-right">
                                        {{ $detalle->product->name }}
                                    </td>

                                    <td style="padding:0.3rem;" class="text-right">
                                        {{ number_format($detalle->price, 2) }}
                                    </td>


                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <h5 class="text-center font-weight-bold">Total de la venta</h5>
                            </td>

                            <td class="text-right">
                                <h6>{{ number_format($sumAmountDetails, 2) }}</h6>
                            </td>
                        </tr>
                    </tfoot>
                    </thead>
                </table>

            </div>


            <b>Detalle del credito # {{ $creditId }}

        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white" style="background:#3b3f5c;">
                        <tr height="30px">
                            <th class="table-th text-white text-center">Numero de cuota</th>
                            <th class="table-th text-white text-center">Fecha vencimiento</th>
                            <th class="table-th text-white text-center">Monto cuota</th>
                            <th class="table-th text-white text-center">Pagado</th>
                            <th class="table-th text-white text-center">Pendiente</th>
                            <th class="table-th text-white text-center">Status</th>

                        </tr>
                    <tbody>
                        @if ($creditDetails)
                            @foreach ($creditDetails as $key=>$detalle)

                                <tr >

                                    <td style="padding:0.3rem;">
                                        {{ $key +1 }}
                                    </td>
                                    <td style="padding:0.3rem;" >
                                        {{ $detalle->expiration_date }}
                                    </td>
                                    <td style="padding:0.3rem;" class="text-right">
                                        {{ number_format($detalle->amount, 2) }}
                                    </td>

                                    <td style="padding:0.3rem;" class="text-right">
                                        {{ number_format($detalle->total, 2) }}
                                    </td>
                                    <td style="padding:0.3rem;" class="text-right">
                                        {{ number_format($detalle->amount - $detalle->total, 2) }}
                                    </td>
                                    <td style="padding:0.3rem;" class="text-right">
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
                                <h3 class="text-center font-weight-bold">Totales</h3>
                            </td>
                            <td class="text-right">
                                <h4>{{ number_format($sumTotalDetails, 2) }}</h4>
                            </td>
                            <td class="text-right">
                                <h4>{{ number_format($sumAmountDetails, 2) }}</h4>
                            </td>
                        </tr>
                    </tfoot>
                    </thead>
                </table>

            </div>


        </div>

    </div>
</div>
