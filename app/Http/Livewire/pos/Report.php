<?php

namespace App\Http\Livewire\pos;

use Livewire\Component;

use App\Models\Product;
use App\Models\Client;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Credit;
use App\Models\PaymentInstallment;
use App\Models\Installment;
use Livewire\WithPagination;
use DB;

class Report extends Component
{
    use WithPagination;
    public $start_date,$end_date,$componentName,$pageTitle,$pagination,$details,$sumDetails,$countDetails,$saleId;
    protected $paginationTheme ='bootstrap';
    public function mount(){

        $this->componentName = "Reporte";
        $this->pageTitle = "Listado de Ventas";
        $today = date('Y-m-d');
        $this->start_date= $today;
        $this->end_date= $today;
        $this->pagination =10;
        $this->sumDetails =0;
        $this->countDetails=0;
        $this->saleId;

    }
    public function render()
    {

        $sales  = Sale::orderBy('id','desc')->whereBetween('date', [$this->start_date, $this->end_date])->paginate($this->pagination);
        return view('livewire.pos.report',compact('sales'));
    }
    public function getDetails($saleId){
        $this->saleId =$saleId;
        $this->details = SaleDetail::select(['id','price','quantity'])->selectRaw('price * quantity as importe')->
        addSelect(['name' => Product::select('name')
        ->whereColumn('id', 'sale_details.product_id')
    ])->where('sale_id',$saleId)->get();

#dd($this->details);

        $this->countDetails = $this->details->sum('quantity');
        $this->sumDetails = $this->details->sum('importe');
        $this->emit('showModal','Detail');

    }


}
