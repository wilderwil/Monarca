<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Products extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $search, $image, $selectedId, $pageTitle, $componentName;
    public $cost,$price,$stock,$alert,$size,$color,$placa,$features,$category_id;
    private $pagination = 10;
    protected $paginationTheme ='bootstrap';
        public function mount(){
        $this->pageTitle = "Listado";
        $this->componentName = "Productos";
    }
    public function render()
    {

       if(strlen($this->search) > 0)
        {
            $products = Product::where('name','like','%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $products = Product::orderBy('id','desc')->paginate($this->pagination);
        }
        $categories = Category::all()->pluck('name', 'id');
            return view('livewire.product.products',compact('products','categories'));
     }
     public function edit($id)
     {
         $product = Product::find($id,['id','name','image','cost','price','stock','alert','size','color','placa','features','category_id']);
         $this->name = $product->name;
         $this->selectedId = $product->id;
         $this->image = null;
         $this->cost = $product->cost;
         $this->price = $product->price;
         $this->stock = $product->stock;
         $this->alert = $product->alert;
         $this->size = $product->size;
         $this->color = $product->color;
         $this->placa = $product->placa;
         $this->features = $product->features;
         $this->category_id = $product->category_id;


         $this->emit('showModal');
        # return view('admin.roles.edit', compact('role', 'permissions'));
     }
     public function store(){
         $rules = [
             'name'=>'required|unique:products|min:3',
             'cost'=>'required|numeric',
             'price'=>'required|numeric',
             'stock'=>'required|integer',
             'alert'=>'integer',
             'image' =>'max:255',
             'size'=>'nullable',
             'color' =>'max:50',
             'placa' =>'max:50',
             'features'=>'max:255',
             'category_id' =>'integer',


        ];
         $messages = [
             'name.required'=>'Nombre de Producto es requerido',
             'name.unique'=>'Nombre de Producto ya existe',
             'name.min'=>'Nombre de la Producto debe tener al menos 3 carácteres',
             'cost.required'=>'Costo es requerido',
             'price.required'=>'Precio es  requerido',
             'stock.required'=>'Stock es requerido',
             'stock.integer'=>'Stock deber ser un numero ',
             'alert.integer'=>'Debe ingresar un numero de inventario minimo',
             'size.integer'=>'Talla deber ser un numero ',
             'color.max'=>'Color es maximo 50 carácteres',
             'placa.max'=>'Placa  es maximo 50 carácteres',
             'feactures.max'=>'Carácteristicas debe ser  maximo 50 carácteres',
        ];
        $this->validate($rules,$messages);
        $product = Product::create([
            'name'=>$this->name,
            'cost'=>$this->cost,
            'price'=>$this->price,
            'stock'=>$this->stock,
            'alert'=>$this->alert,
            'size'=>$this->size != '' ? $this->size : null,
            'color'=>$this->color,
            'placa'=>$this->placa,
            'features'=>$this->features,
            'category_id'=>$this->category_id,
        ]);
        $customFileName;
        if($this->image){
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/products',$customFileName);
            $product->image = $customFileName;
            $product->save();
        }

        $this->resetUI();
        $this->emit('product-added', 'Producto Registrada');

     }
     public function resetUI(){
        $this->name= '';
        $this->image = null;
        $this->search = '';
        $this->selectedId=0;
        $this->cost ='';
        $this->price='';
        $this->stock = '';
        $this->alert = '';
        $this->size = '';
        $this->color = '';
        $this->placa = '';
        $this->features ='';

     }
     public function update(){
        $rules = [
            'name'=>"required|unique:products,name,{$this->selectedId}|min:3",
            'cost'=>'required|numeric',
            'price'=>'required|numeric',
            'stock'=>'required|integer',
            'alert'=>'integer',
            'image' =>'max:255',
            'size'=>'nullable',
            'color' =>'max:50',
            'placa' =>'max:50',
            'features'=>'max:255',
            'category_id' =>'integer',
       ];
        $messages = [
            'name.required'=>'Nombre de Producto es requerido',
            'name.unique'=>'Nombre de Producto ya existe',
            'name.min'=>'Nombre de la Producto debe tener al menos 3 carácteres',
            'cost.required'=>'Costo es requerido',
            'price.required'=>'Precio es  requerido',
            'stock.required'=>'Stock es requerido',
            'stock.integer'=>'Stock deber ser un numero ',
            'alert.integer'=>'Debe ingresar un numero de inventario minimo',
            'size.integer'=>'Talla deber ser un numero ',
            'color.max'=>'Color es maximo 50 carácteres',
            'placa.max'=>'Placa  es maximo 50 carácteres',
            'feactures.max'=>'Carácteristicas debe ser  maximo 50 carácteres',

       ];
       $this->validate($rules,$messages);
       $product = product::find($this->selectedId);
       $product->update([
           'name'=>$this->name,
           'cost'=>$this->cost,
           'price'=>$this->price,
           'stock'=>$this->stock,
           'alert'=>$this->alert,
           'size'=>$this->size,
           'color'=>$this->color,
           'placa'=>$this->placa,
           'features'=>$this->features,
           'category_id'=>$this->category_id,

        ]);
       if($this->image){
           $customFileName = uniqid().'_.'. $this->image->extension();
           $this->image->storeAs('public/products',$customFileName);
           $imageToDelete = $product->image;
           $product->image = $customFileName;
           $product->save();
           if ($imageToDelete != null){
               if(file_exists('storage/products/'.$imageToDelete)){
                   unlink('storage/products/'.$imageToDelete);
               }
           }

       }
       $this->resetUI();
       $this->emit('product-updated','Producto Actualizado');
    }
    public function destroy($id){
        $product = Product::find($id);
        $imageToDelete = $product->image;
        $product->delete();
        if ($imageToDelete != null){
            if(file_exists('storage/products/'.$imageToDelete)){
                unlink('storage/products/'.$imageToDelete);
            }
        }
        $this->resetUI();
        $this->emit('product-delete','Producto Eliminado');
    }
}