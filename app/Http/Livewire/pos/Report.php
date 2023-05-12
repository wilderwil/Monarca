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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        #dd(Auth()->user()->givePermissionTo('admin.delete.sale'));
        #$permission = Permission::create(['name' => 'delete sale','description'=>'Borrar ventas']);die;

        $sales  = Sale::orderBy('id','desc')->whereBetween('date', [$this->start_date, $this->end_date])->paginate($this->pagination);
        #dd($sales->user);
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

    public function deleteSale($saleId){

        DB::beginTransaction();

        try {
            $sale = Sale::find($saleId);
            if(strcmp($sale->tipo,'crédito') == 0){
            $details = SaleDetail::select(['id','product_id','quantity'])->where('sale_id',$saleId)->get();
            # dd($details);
            if($details){
                foreach($details as $detail){
                    $product = product::find($detail->product_id);
                    $product->update([
                        'stock'=>$product->stock + $detail->quantity,
                    ]);
                    $detail->delete();
                    //ojo guardar en log
                }
                Sale::find($saleId);
            }
            $credit = Credit::select('id')->where('venta_id',$saleId)->get();
            //Buscar cuotas asociadas al credito para borrarlas
            $installments = Credit::find($credit[0]->id)->installments;
            foreach ($installments as $installment){
                //buscar los pagos asociados a las cuotas para borrarlos
                    foreach ($installment->paymentsInstallment as $paymentInstallment) {
                        $paymentInstallment->delete();
                        # code...
                    }
                    $installment->delete();
            }
            $credit[0]->delete();

        }
        $sale->delete();
        DB::commit();
            $this->emit('delete-sale','Se ha eliminado la venta: '. $saleId);
        } catch (\Throwable $th) {
            DB::rollback();
            $this->emit('delete-error ',$th->getMessage());
        }


    }
}