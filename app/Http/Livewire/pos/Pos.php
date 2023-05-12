<?php

namespace App\Http\Livewire\pos;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart ;
use App\Models\Product;
use App\Models\Client;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Credit;
use App\Models\PaymentInstallment;
use App\Models\Installment;
use DB;
class Pos extends Component
{
    public $total,$itemsQuantity,$tipo_venta,$search,$cuotas,$periodo,$inicial,$client,$client_name,$client_image, $client_rif,$fecha;
    protected $listeners = ['removeItem'=>'removeItem','clearCart'=>'clearCart','saveSale'=>'saveSale','addToCart'=>'addToCart','addClientToCart'=>'addClientToCart'];
    public function mount(){
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->tipo_venta = 'contado';
        $this->fecha =  date('Y-m-d');



    }
    public function render()
    {

        $cart = Cart::getContent()->sortBy('name');
        return view('livewire.pos.pos',compact('cart'));
    }
    public function addToCart($id,$cant=1){
        $product = Product::find($id);
        if($product == null || empty($product))
        {
            //product no encontrado
        }else{
            if($this->inCart($product->id)){
                $this->increaseQty($product->id);
                return;
            }
            if($product->stock < 1){
                $this->emit('no-stock','Stock Insuficiente');
                return;
            }
            Cart::add($product->id,$product->name,$product->price,$cant,$product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('addToCartOk','Producto Agregado');
        }


    }

    public function inCart($productId){
       $exist = Cart::get($productId);
       if($exist){
            return true;
       }
       return false;
    }
    public function increaseQty($productId,$cant=1){
        $title = "";
        $product = Product::find($productId);
        $exist = Cart::get($product->id);
        if($exist){
            $title = "Cantidad Actualizada";

        }else{
            $title = "Producto Agregado";
        }
        if($exist){
        if($product->stock < $cant + $exist->quatity){
            $this->emit('no-stock',"Stock Insuficiente");
            return;
        }
        }
        Cart::add($product->id,$product->name,$product->price,$cant,$product->image);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('addToCartOk',$title);
    }
    public function updateQty($productId,$cant=1){
        $title = "";
        $product = Product::find($productId);
        $exist = Cart::get($product->id);
        if($exist){
            $title = "Cantidad Actualizada";

        }else{
            $title = "Producto Agregado";
        }

        if($exist){
            if($product->stock < $cant ){
                $this->emit('no-stock',"Stock Insuficiente");
                return;
            }
        }
        $this->removeItem($productId);
        if($cant > 0){
            Cart::add($product->id,$product->name,$product->price,$cant,$product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('addToCartOk',$title);
        }

    }
    public function updatePrice($productId,$cant =1, $price){
        $title = "";
        $product = Product::find($productId);
        $exist = Cart::get($product->id);
        if($exist){
            $title = "Precio Actualizado";

        }else{
            $title = "Producto Agregado";
        }

        if($exist){
            if($product->stock < $cant ){
                $this->emit('no-stock',"Stock Insuficiente");
                return;
            }
        }
        $this->removeItem($productId);
        if($cant > 0){
            Cart::add($product->id,$product->name,$price,$cant,$product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('addToCartOk',$title);
        }

    }
    public function removeItem($productId){
        Cart::remove($productId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('addToCartOk',"Producto Eliminado");

    }
    public function decreaseQty($productId){
        $item = Cart::get($productId);
        Cart::remove($productId);
        $newQty = $item->quantity - 1;
        if ($newQty > 0){
            Cart::add($item->id,$item->name,$item->price,$newQty,$item->attributes[0]);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('addToCartOk','Cantidad Actualizada');
            return;
        }
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

    }
    public function clearCart(){
        Cart::clear();
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('addToCartOk',"Venta Vacia");
    }
    public function saveSale(){
        if($this->total <=0){
            $this->emit('sale-error','No hay productos agregados ');
            return;
        }
        if($this->client == '' ){
            $this->emit('sale-error','Debe agregar un cliente ');
            return;
        }
        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'client_id'=>$this->client,
                'date'=> $this->fecha,
                'total'=>$this->total,
                'tipo' =>$this->tipo_venta,
                'user_id'=>Auth()->user()->id,
            ]);
            if($sale){
                $items = Cart::getContent();
                foreach($items as $item){
                    SaleDetail::create([
                        'price'=>$item->price,
                        'quantity'=> $item->quantity,
                        'product_id'=> $item->id,
                        'sale_id' => $sale->id,
                    ]);
                    //update Stock
                    $product = Product::find($item->id);
                    $product->stock = $product->stock - $item->quantity;
                    $product->save();
                }
                if($this->tipo_venta == 'crédito'){
                    $hoy = $this->fecha;
                    $nueva_fecha = date('Y-m-d', strtotime($hoy . ' +1 day'));
                    $monto_credito = Cart::getTotal();
                    $installment_amount = ($monto_credito - $this->inicial ) / $this->cuotas;
                    $fechas_vencimiento = $this->generar_fechas_vencimiento($nueva_fecha,$this->cuotas, $this->periodo);
                    $credit = Credit::create([
                        'installments_quantity'=>$this->cuotas,
                        'total_amount'=> $monto_credito,
                        'venta_id'=>$sale->id]);
                    if($credit){
                        if($this->inicial>0){

                            $installment = Installment::create([
                                'expiration_date' => $hoy,
                                'amount'=>$this->inicial,
                                'estado'=>'pagado',
                                'credit_id'=> $credit->id,
                            ]);
                            $installment_payment = PaymentInstallment::create([
                                'amount_paid' => $this->inicial,
                                'installment_id'=>$installment->id,
                            ]);

                        }
                    foreach($fechas_vencimiento as $key => $fechas){
                        $installment = Installment::create([
                            'expiration_date' => $fechas,
                            'amount'=>$installment_amount,
                            'estado'=>'pendiente',
                            'credit_id'=> $credit->id,
                        ]);
                    }
                }
                }
            }
            DB::commit();
            Cart::clear();
            $this->resetUI();

            $this->emit('sale-ok','venta registrada con exito');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->emit('sale-error ',$th->getMessage());
        }

    }
    public function addClientToCart($client_id){

        $client = CLient::find($client_id);
        $this->client =$client->id;
        $this->client_name = $client->nombre .' '.$client->apellido;
        $this->client_image = $client->image;
        $this->client_rif = $client->tipo_rif.'-'.$client->cedula;
        $this->emit('addToCartOk','CLiente Agregado');
    }
    public function resetUI(){
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->tipo_venta='contado';
        $this->search='';
        $this->cuotas='';
        $this->periodo='';
        $this->inicial=0;
        $this->client='';
        $this->client_name='';
        $this->client_image=null;
        $this->client_rif='';

    }

    public function generar_fechas_vencimiento($fecha_inicio, $num_cuotas, $periodo) {
       /* $fechas_vencimiento = array();
        $fecha_actual = date_create_from_format('Y-m-d', $fecha_inicio);
        for ($i=0; $i<$num_cuotas; $i++) {
            if ($periodo == 'diario') {
                $fecha_actual->modify('+1 day');
            } elseif ($periodo == 'semanal') {
                $fecha_actual->modify('+1 week');
            } elseif ($periodo == 'quincenal') {
                $fecha_actual->modify('+2 weeks');
            } elseif ($periodo == 'mensual') {
                $mes_siguiente = ($fecha_actual->format('n') % 12) + 1;
                $dia_actual = $fecha_actual->format('j');
                $fecha_actual->setDate($fecha_actual->format('Y'), $mes_siguiente, min($dia_actual, cal_days_in_month(CAL_GREGORIAN, $mes_siguiente, $fecha_actual->format('Y'))));
            }
            $fechas_vencimiento[] = $fecha_actual->format('Y-m-d');
        }
        return $fechas_vencimiento;
        */
        $fechas_vencimiento = array();
        $hoy = $this->fecha;
        $fecha_actual = date('Y-m-d', strtotime($hoy . ' +1 day'));
        for ($i=0; $i<$num_cuotas; $i++) {
            if ($periodo == 'diario') {
                $fecha_actual = date('Y-m-d', strtotime($fecha_actual . ' +1 day'));
            } elseif ($periodo == 'semanal') {
                $fecha_actual = date('Y-m-d', strtotime($fecha_actual . ' +1 week'));
            } elseif ($periodo == 'quincenal') {
                $fecha_actual = date('Y-m-d', strtotime($fecha_actual . ' +2 weeks'));
            } elseif ($periodo == 'mensual') {
                $mes_siguiente = date('n', strtotime($fecha_actual . ' +1 month'));
                $anio_siguiente = date('Y', strtotime($fecha_actual . ' +1 month'));
                $dia_actual = date('j', strtotime($fecha_actual));
                $fecha_actual = date('Y-m-d', strtotime($anio_siguiente . '-' . $mes_siguiente . '-' . min($dia_actual, cal_days_in_month(CAL_GREGORIAN, $mes_siguiente, $anio_siguiente))));
            }
            $fechas_vencimiento[] = $fecha_actual;
        }
        return $fechas_vencimiento;
    }



}
