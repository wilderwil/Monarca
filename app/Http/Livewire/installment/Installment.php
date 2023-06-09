<?php

namespace App\Http\Livewire\installment;

use Livewire\Component;
use App\Models\Product;
use App\Models\Credit;
use App\Models\Client;
use App\Models\Installment as InstallmentModel;
use Livewire\WithPagination;
use DB;
class Installment extends Component
{
    public $search,$componentName, $pageTitle,$creditId,$details,$sumTotalDetails,$sumAmountDetails;
    private $pagination = 5;
    #protected $paginationTheme ='bootstrap';

     public function mount(){
        $this->componentName = "Cuotas Vencidas";
        $this->pageTitle = "Listado";


    }
    public function render()
    {
        $installments = InstallmentModel::where('expiration_date','<',now())
        ->where('estado','pendiente')->get();
       # dd($installments);
      /* $pendingPayments = DB::table('clients')
       ->join('sales', 'clients.id', '=', 'sales.client_id')
       ->leftJoin('credits', 'sales.id', '=', 'credits.venta_id')
       ->leftJoin('installments', 'credits.id', '=', 'installments.credit_id')
       ->select('clients.nombre', DB::raw('SUM(sales.total - COALESCE((SELECT SUM(amount_paid) FROM payment_installments WHERE installment_id = installments.id), 0)) AS pending_payments'))
       ->groupBy('clients.id', 'clients.nombre')
       ->havingRaw('pending_payments > 0')
       ->get();*/
       /*$pendingPayments = DB::table('clients')
       ->join('sales', 'clients.id', '=', 'sales.client_id')
       ->leftJoin('credits', 'sales.id', '=', 'credits.venta_id')
       ->leftJoin('installments', 'credits.id', '=', 'installments.credit_id')
       ->select('clients.nombre',)
       ->groupBy('clients.id', 'clients.nombre')
       ->get();
       $clients = Client::select('clients.*', DB::raw('SUM(installments.amount) - IFNULL(SUM(payments.amount_paid), 0) AS amount_pending'))
                ->join('sales', 'sales.client_id', '=', 'clients.id')
                ->join('sale_details', 'sale_details.sale_id', '=', 'sales.id')
                ->join('installments', 'installments.credit_id', '=', 'sales.credit_id')
                ->leftJoin('payment_installments AS payments', function ($join) {
                    $join->on('payments.installment_id', '=', 'installments.id')
                         ->whereNull('payments.deleted_at');
                })
                ->where('installments.estado', '=', 'pendiente')
                ->groupBy('clients.id')
                ->get();*/
       /* $credits = Credit::select('installments.id as installmentid','total_amount','amount','credits.id','payment_installments.amount_paid',\DB::raw("SUM(payment_installments.amount_paid) as total"))
        ->leftJoin('installments','credits.id' ,'=', 'installments.credit_id')
        ->leftJoin('payment_installments','installments.id','=','payment_installments.installment_id')
        ->where('estado','pendiente')
        ->groupBy('installments.id','credits.total_amount','installments.amount','credits.id','payment_installments.amount_paid','total')->get();*/
        //esta funciona
        /*
        $credits = Credit::select('installments.id as installmentid','total_amount','amount','credits.id',\DB::raw("SUM(payment_installments.amount_paid) as total"))
        ->leftJoin('installments','credits.id' ,'=', 'installments.credit_id')
        ->leftJoin('payment_installments','installments.id','=','payment_installments.installment_id')
        ->where('estado','pendiente')
        ->groupBy('installments.id','credits.total_amount','installments.amount','credits.id')->get();
*/
// ojo cuotas pendientes
$credits = Credit::select('installments.id as installmentid','total_amount','amount','credits.id',\DB::raw("SUM(payment_installments.amount_paid) as total"),\DB::raw("CONCAT(clients.nombre, ' ', clients.apellido) as nombre"))
        ->leftJoin('installments','credits.id' ,'=', 'installments.credit_id')
        ->leftJoin('payment_installments','installments.id','=','payment_installments.installment_id')
        ->leftJoin('sales','credits.venta_id','=','sales.id')
        ->leftJoin('clients','sales.client_id','=','clients.id')
        ->where('estado','pendiente')
        ->groupBy('installments.id','credits.total_amount','installments.amount','credits.id','clients.nombre','clients.apellido')->get();
// cuotas vencidas
$installments = Credit::select('installments.id as installmentid','total_amount','amount','credits.id',\DB::raw("SUM(payment_installments.amount_paid) as total"),\DB::raw("CONCAT(clients.nombre, ' ', clients.apellido) as nombre"),'expiration_date','clients.cel')
        ->leftJoin('installments','credits.id' ,'=', 'installments.credit_id')
        ->leftJoin('payment_installments','installments.id','=','payment_installments.installment_id')
        ->leftJoin('sales','credits.venta_id','=','sales.id')
        ->leftJoin('clients','sales.client_id','=','clients.id')
        ->where('estado','pendiente')
        ->whereDate('expiration_date','<',now())
        ->groupBy('installments.id','credits.total_amount','installments.amount','credits.id','clients.nombre','clients.apellido','expiration_date','clients.cel')
        ->orderBy('expiration_date')->get();
//dd($credits);

        return view('livewire.installment.installment',compact('installments'));
    }




    public function getDetails($creditId){
        $this->creditId =$creditId;
        $this->details = Credit::select('installments.id as installmentid','total_amount','amount','credits.id',\DB::raw("SUM(payment_installments.amount_paid) as total"),\DB::raw("CONCAT(clients.nombre, ' ', clients.apellido) as nombre"),'expiration_date','clients.cel')
        ->leftJoin('installments','credits.id' ,'=', 'installments.credit_id')
        ->leftJoin('payment_installments','installments.id','=','payment_installments.installment_id')
        ->leftJoin('sales','credits.venta_id','=','sales.id')
        ->leftJoin('clients','sales.client_id','=','clients.id')
    //    ->where('estado','pendiente')
        ->where('credits.id',$creditId)
        ->groupBy('installments.id','credits.total_amount','installments.amount','credits.id','clients.nombre','clients.apellido','expiration_date','clients.cel')
        ->orderBy('installments.id')->get();


#dd($this->details);

        //$this->countDetails = $this->details->sum('quantity');
        $this->sumAmountDetails = $this->details->sum('amount');
        $this->sumTotalDetails = $this->details->sum('total');
        $this->emit('showModal','Detail');

    }

}
