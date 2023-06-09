@include('common.modal-header')
<div class="row">
    <div class="col-sm-12 ">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><span
                        class="fa fa-tags"></span></span>
            </div>

            {{ Form::select('category_id', $categories, null, ['wire:model.lazy'=>'category_id','placeholder' => 'Seleccione una categoria', 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-edit"></span></span>

            </div>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Nombre de producto">
        </div>
        @error('name')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fas fa-money-bill" aria-hidden="true"></i> <span
                        class="fa fa-money"></span></span>
            </div>
            <input type="text" wire:model.lazy="cost" class="form-control" placeholder="Costo">
            @error('cost')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fas fa-money-bill" ></span> <span
                        class="fa fa-money"></span></span>
            </div>

            {{ Form::number('price', 'value', ['wire:model.lazy' => 'price', 'placeholder' => 'Precio de Venta', 'class' => 'form-control']) }}
            @error('price')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span
                    class="fas fa-cubes"></span>
            </div>

            {{ Form::number('stock', 'value', ['wire:model.lazy' => 'stock', 'placeholder' => 'Stock o Existencia', 'class' => 'form-control']) }}
            @error('stock')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span
                    class="fas fa-bomb"></span>
            </div>

            {{ Form::number('alert', 'value', ['wire:model.lazy' => 'alert', 'placeholder' => 'Stock Minimo', 'class' => 'form-control']) }}
            @error('alert')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span
                    class="fas fa-ruler-combined"></span>
            </div>

            {{ Form::number('size', 'value', ['wire:model.lazy' => 'size', 'placeholder' => 'Talla', 'class' => 'form-control']) }}
            @error('size')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span
                    class="fas fa-eye-dropper"></span>
            </div>

            {{ Form::text('color', 'value', ['wire:model.lazy' => 'color', 'placeholder' => 'Color', 'class' => 'form-control']) }}
            @error('color')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span
                    class="fas fa-motorcycle"></span>
            </div>

            {{ Form::text('placa', 'value', ['wire:model.lazy' => 'placa', 'placeholder' => 'Placa', 'class' => 'form-control']) }}
            @error('placa')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <span
                    class="fas fa-newspaper"></span>
            </div>

            {{ Form::text('features', 'value', ['wire:model.lazy' => 'features', 'placeholder' => 'Caracteristicas', 'class' => 'form-control']) }}
            @error('features')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
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
