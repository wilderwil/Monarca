<div>
    <style></style>
    <div id="div-alert">

    </div>
   <div class="row">

       <div class="col-sm-12 col-md-8">
           <!-- detail  -->
           @include('livewire.pos.partials.detail')
       </div>
       <div class="col-sm-12 col-md-4">
        <!-- detail  -->
        @include('livewire.pos.partials.total')
        @include('livewire.pos.partials.conditions')
    </div>

   </div>
   <script>
    document.addEventListener('DOMContentLoaded', function() {

        Livewire.on('no-stock', msg => {
            alertText =
                `<x-adminlte-alert class="bg-danger text-uppercase"  icon="fa fa-lg fa-thumbs-down" title="Error" dismissable> ` +
                msg + `!</x-adminlte-alert>`;
            $("#div-alert").html(alertText)

        });
        Livewire.on('addToCartOk', msg => {
            alertText =
                `<x-adminlte-alert class="bg-success text-uppercase"  icon="fa fa-lg fa-thumbs-up" title="Hecho" dismissable> ` +
                msg + `!</x-adminlte-alert>`;
            $("#div-alert").html(alertText)

        });
        Livewire.on('sale-error', msg => {
            alertText =
                `<x-adminlte-alert class="bg-danger text-uppercase"  icon="fa fa-lg fa-thumbs-up" title="Error" dismissable> ` +
                msg + `!</x-adminlte-alert>`;
            $("#div-alert").html(alertText)

        });

    });
</script>
</div>
