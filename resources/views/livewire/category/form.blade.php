@include('common.modal-header')
<div class="row">
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">    <span class="fas fa-edit"></span></span>
            
            </div>
            <input type="text" wire:model.lazy="name" class="form-control" >
        </div>
            @error('name')
            <span class="text-danger er">{{$message}}</span>   
            @enderror
    </div>
    <div class="col-sm-12 mt-3">
        <div class="form-group custom-file">
            <input type="file" class="custom-file-input form-control" wire:model='image' accept="image/png,image/gif,image/jpg">
            <label class="custom-file-label">Imagen {{$image}}</label>
        </div>
          @error('image')
            <span class="text-danger er">{{$message}}</span>   
            @enderror
    </div>
</div>
@include('common.modal-footer')