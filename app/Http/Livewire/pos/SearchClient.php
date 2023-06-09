<?php

namespace App\Http\Livewire\pos;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithPagination;
class SearchClient extends Component
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
            $clients = Client::where('cedula','like','%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $clients = Client::orderBy('id','desc')->paginate($this->pagination);
        }
        return view('livewire.pos.partials.search-client',compact('clients'));
    }
    public function addClient($id){
        $this->search ='';
        $this->emit('addClientToCart',$id);
    }

}