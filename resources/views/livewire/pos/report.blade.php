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
                        <div class="col-sm-12 col-md-2 ">
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
                                <x-adminlte-button wire:click="$refresh" label="Consultar" theme="dark"
                                    icon="fas fa-dropeyes" />
                            </div>
                            <div class="col-sm-12">

                            </div>

                        </div>
                        <div class="col-sm-12 col-md-10 ">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripe mt-1">
                                    <thead class="text-white" style="background:#3b3f5c;">
                                        <tr>
                                            <th class="table-th text-white">N°</th>
                                            <th class="table-th text-white">Fecha</th>
                                            <th class="table-th text-white">Total</th>
                                            <th class="table-th text-white">Tipo</th>
                                            <th class="table-th text-white">Usuario</th>
                                            <th class="table-th text-white">Detalle</th>

                                        </tr>
                                    <tbody>
                                        @if (count($sales) < 1)
                                            <tr>
                                                <td colspan="6">
                                                    <h5>No hay ventas registradas para ese período</h5>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($sales as $sale)
                                                <tr>
                                                    <td>
                                                        <h6>{{ $sale->id }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{ \Carbon\Carbon::parse($sale->date)->format('d-m-Y') }}
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{ $sale->total }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{ $sale->tipo }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{ $sale->user->name }}</h6>
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" class="btn btn-dark mtmobile"
                                                            title="Ver"
                                                            wire:click.prevent="getDetails({{ $sale->id }})"><i
                                                                class="fa fa-eye"></i></a>



                                                    </td>


                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    </thead>
                                </table>
                                @if (count($sales) > 0)
                                    {{ $sales->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if ($details)
    @include('livewire.pos.sales-detail')
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        Livewire.on('showModal', msg => {
            $("#modalDetails").modal('show');
        });
    });
</script>
