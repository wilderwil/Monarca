<?php

namespace App\Http\Livewire\pos;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
class Search extends Component
{
    public $search;
    private $pagination = 5;
    #protected $paginationTheme ='bootstrap';

     public function mount(){



    }
    public function render()
    {
        if(strlen($this->search) > 0)
        {
            $products = Product::where('name','like','%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $products = Product::orderBy('id','desc')->paginate($this->pagination);
        }
        return view('livewire.pos.partials.search',compact('products'));
    }
    public function addProduct($id){
        $this->search ='';
        $this->emit('addToCart',$id);
    }

}
