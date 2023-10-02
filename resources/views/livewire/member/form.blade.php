@include('common.modal-header')
<div class="row">
    <div class="col-sm-12 ">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><span
                        class="fa fa-address-card"></span></span>
            </div>
            <input type="text" wire:model.lazy="cedula" class="form-control" placeholder="Cedula">

        </div>
        @error('cedula')
        <span class="text-danger er">{{ $message }}</span>
    @enderror
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-user"></span></span>

            </div>
            <input type="text" wire:model.lazy="titulo" class="form-control" placeholder="Titulo">
        </div>
        @error('titulo')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-user"></span></span>

            </div>
            <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="Nombres">
        </div>
        @error('nombre')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-user"></span></span>

            </div>
            <input type="text" wire:model.lazy="apellido" class="form-control" placeholder="Apellido">
        </div>
        @error('apellido')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-envelope"></span></span>

            </div>
            <input type="text" wire:model.lazy="email" class="form-control" placeholder="Email">
        </div>
        @error('email')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-12 mt-3">

        <div class="col-sm-6">{{ Form::select('member_type', ['socio'=>'Socio','socio-honorifico'=>'Socio Honorifico'], null, ['wire:model.lazy'=>'member_type','placeholder' => 'Seleccione tipo de socio', 'class' => 'form-control']) }}
        </div>
        @error('member_type')
            <span class="text-danger er">{{ $message }}</span>
        @enderror


    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-phone"></span></span>

            </div>
            <input type="text" wire:model.lazy="accion" class="form-control" placeholder="Código de la Acción">
        </div>
        @error('accion')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-phone"></span></span>

            </div>
            <input type="text" wire:model.lazy="cel" class="form-control" placeholder="Teléfono">
        </div>
        @error('cel')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-12 mt-3">
        <div class="col-sm-6">{{ Form::select('status', ['solvente'=>'Solvente','insolvente'=>'Insolvente'], null, ['wire:model.lazy'=>'status','placeholder' => 'Seleccione estatus de socio', 'class' => 'form-control']) }}
        </div>
        @error('status')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>


</div>
@include('common.modal-footer')
