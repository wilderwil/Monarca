<?php

namespace App\Http\Livewire\pos;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart ;
use App\Models\Product;

use DB;
class Pos extends Component
{
    public $total,$itemsQuantity,$tipo_venta,$search,$cuotas,$periodo,$inicial;
    protected $listeners = ['removeItem'=>'removeItem','clearCart'=>'clearCart','saveSale'=>'saveSale','addToCart'=>'addToCart'];
    public function mount(){
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
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
        }

    }
    public function clearCart(){
        Cart::clear();
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('addToCartOk',"Venta Vacia");
    }
    public function SaveSale(){
        if($this->total <=0){
            $this->emit('sale-error','Agrega Productos ');
            return;
        }
        #DB::beginTransaction();
        // guardar la venta
        try {
            $sale =
        } catch (\Throwable $th) {
            //throw $th;
        }
        #DB::commit();
    }

}