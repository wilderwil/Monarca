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
                        <div class="col-sm-12 col-md-3 ">
                            <div class="form-group">
                                {!! Form::label('start_date', 'Fecha Inicio') !!}
                                {!! Form::date('start_date', $this->start_date, [
                                    'wire:model' => 'start_date',
                                    'class' => 'form-control',
                                    'placeholder' => 'Fecha desde',
                                ]) !!}
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 ">
                            <div class="form-group">
                                {!! Form::label('end_date', 'Fecha Fin') !!}
                                {!! Form::date('end_date', $this->end_date, [
                                    'wire:model' => 'end_date',
                                    'class' => 'form-control',
                                    'placeholder' => 'Fecha hasta',
                                ]) !!}
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 mt-1">
                            <div class="form-group">
                                <x-adminlte-button wire:click="$refresh" label="Consultar" theme="dark"
                                    icon="fas fa-dropeyes" class="mt-4" />

                            </div>
                        </div>

                    </div>
                </div>
            </div>
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
                                <th class="table-th text-white text-center">Monto Pendiente</th>
                                <th class="table-th text-white text-center">Ver detalle</th>
                            </tr>
                        <tbody>
                            @foreach ($installments_pending as $installment)
                                <tr>
                                    <td class="text-center">
                                        <h6>{{ $installment->id }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $installment->nombre }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $installment->cel }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $installment->expiration_date }}</h6>
                                    </td>
                                    <td class="text-right">
                                        <h6>{{ number_format($installment->total_amount ?? 0, 2) }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ number_format($installment->amount ?? 0, 2) }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ number_format($installment->total ?? 0, 2) }}</h6>
                                    </td>
                                    <td class="text-right">
                                        <h6>{{ number_format($installment->amount - $installment->total, 2) }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Ver"
                                            wire:click.prevent="getDetalle({{ $installment->id }})"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Pagar"
                                            wire:click.prevent="putPayment({{ $installment->installmentid }}, {{ number_format($installment->total ?? 0, 2) }})"><i
                                                class="fa fa-money-bill"></i></a>


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
                                    <h5 class="text-center">{{ $installments_pending->sum('amount') }}</h5>
                                </td>
                                <td>
                                    <h5 class="text-center">{{ $installments_pending->sum('total') }}</h5>
                                </td>
                                <td class="text-right">
                                    <h5>{{ $installments_pending->sum('amount') - $installments_pending->sum('total') }}
                                    </h5>
                                </td>
                            </tr>
                        </tfoot>
                        </thead>
                    </table>
                    {{$installments_pending->links()}}
                </div>
            </div>
        </div>
    </div>
    <div id="div-alert">

    </div>
    @if ($details)
        @include('livewire.installment.credit-detail-pending')
    @endif
    @if ($installmentDetail)
        @include('livewire.installment.installment-detail-pending')
    @endif
</div>






<script>
    document.addEventListener('DOMContentLoaded', function() {

        Livewire.on('showModal2', msg => {

            $("#modalDetails").modal('show');
        });
        Livewire.on('payment-updated', msg => {

            $("#modalInstallmentsDetails").modal('show');
        });
        Livewire.on('payment-ok', msg => {
            alertText =
                `<x-adminlte-alert class="bg-teal text-uppercase"  icon="fa fa-lg fa-thumbs-up" title="Hecho" dismissable> ` +
                msg + `!</x-adminlte-alert>`;
            $("#div-alert").html(alertText)
            $("#modalInstallmentsDetails").modal('hide');
        });
        Livewire.on('payment-error', msg => {
            alertText =
                `<x-adminlte-alert class="bg-danger text-uppercase"  icon="fa fa-lg fa-thumbs-down" title="Error" dismissable> ` +
                msg + `!</x-adminlte-alert>`;
            $("#div-alert").html(alertText)
            $("#modalInstallmentsDetails").modal('hide');
        });


    });
</script>
