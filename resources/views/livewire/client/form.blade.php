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
        <div class="row">
        <div class="col-sm-6">{{ Form::select('tipo_rif', ['V'=>'Natural V.-','J'=>'Juridico J.- ', 'G'=>'Gobierno G.-'], null, ['wire:model.lazy'=>'tipo_rif','placeholder' => 'Seleccione tipo de rif', 'class' => 'form-control']) }}
        </div>
        <div class="col-sm-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-id-card"></span></span>

            </div>
            <input type="text" wire:model.lazy="rif" class="form-control" placeholder="Rif">
        </div>
        @error('rif')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
        </div>
    </div>
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
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-map"></span></span>

            </div>
            <input type="text" wire:model.lazy="direccion" class="form-control" placeholder="Dirección">
        </div>
        @error('direccion')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-user"></span></span>

            </div>
            <input type="text" wire:model.lazy="referencia" class="form-control" placeholder="Nombre de Referencia Personal">
        </div>
        @error('referencia')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-phone"></span></span>

            </div>
            <input type="text" wire:model.lazy="cel_referencia" class="form-control" placeholder="Telefono de {{$referencia}}">
        </div>
        @error('cel_referencia')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>


    <div class="col-sm-12 mt-3">
        <div class="form-group custom-file">
            <input type="file" class="custom-file-input form-control" wire:model='image'
                accept="image/png,image/gif,image/jpg">
            <label class="custom-file-label">Imagen {{ $image }}</label>
        </div>
        @error('image')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>

</div>
@include('common.modal-footer')
