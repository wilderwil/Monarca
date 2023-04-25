<div>
    <style></style>
    <div class="row pt-3">
        <div class="col-sm-12">
            <div class="card card-widget">
                <div class="card-header">
                    <h4 class="card-title">
                        <b>{{ $componentName }} | {{ $pageTitle }}</b>
                    </h4>
                    <div class="card-tools">
                        <ul class="nav nav-pills" class="active">
                            <li class="nav-item">
                                <h6 wire:loading class="text-center text-black">Por favor espere</h6>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

           <div class="table-responsive">
                    <table class="table table-bordered table-stripe mt-1">
                        <thead class="text-white" style="background:#3b3f5c;">
                            <tr>
                                <th class="table-th text-white text-center">Crédito ID</th>
                                <th class="table-th text-white text-center">Nombre</th>
                                <th class="table-th text-white text-center">Telefono</th>
                                <th class="table-th text-white text-center">Fecha Vencimiento</th>
                                <th class="table-th text-white text-center">Total Credito</th>
                                <th class="table-th text-white text-center">Monto Cuota</th>
                                <th class="table-th text-white text-center">Monto abonado</th>
                                <th class="table-th text-white text-center">Monto Vencido</th>
                                <th class="table-th text-white text-center">Ver detalle</th>
                            </tr>
                        <tbody>
                            @foreach($installments as $installment)
                            <tr>
                                <td class="text-center">
                                    <h6>{{$installment->id}}</h6>
                                </td>
                                <td>
                                    <h6>{{$installment->nombre}}</h6>
                                </td>
                                <td>
                                    <h6>{{$installment->cel}}</h6>
                                </td>
                                <td>
                                    <h6>{{$installment->expiration_date}}</h6>
                                </td>
                                <td class="text-right">
                                    <h6>{{number_format($installment->total_amount ?? 0,2)}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{number_format($installment->amount ?? 0,2)}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{number_format($installment->total ?? 0,2)}}</h6>
                                </td>
                                <td class="text-right">
                                    <h6>{{number_format($installment->amount - $installment->total,2)}}</h6>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-dark mtmobile"
                                        title="Ver"
                                        wire:click.prevent="getDetails({{ $installment->id }})"><i
                                            class="fa fa-eye"></i></a>



                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <h5 class="text-center font-weight-bold">Totales</h5>
                                </td>
                                <td>
                                    <h5 class="text-center">{{$installments->sum('amount')}}</h5>
                                </td>
                                <td>
                                    <h5 class="text-center">{{$installments->sum('total')}}</h5>
                                </td>
                                <td class="text-right">
                                    <h5 >{{$installments->sum('amount') - $installments->sum('total')}}</h5>
                                </td>
                            </tr>
                        </tfoot>
                        </thead>
                    </table>

                </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if ($details)
    @include('livewire.installment.credit-detail')
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        Livewire.on('showModal', msg => {
            $("#modalDetails").modal('show');
        });
    });
</script>
