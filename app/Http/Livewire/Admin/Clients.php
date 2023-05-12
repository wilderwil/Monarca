<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Client;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Clients extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search, $image, $selectedId, $pageTitle, $componentName;
    public $cedula,$nombre,$apellido,$tipo_rif,$rif,$cel,$direccion,$referencia,$cel_referencia,$email;
    private $pagination = 10;
    protected $paginationTheme ='bootstrap';
        public function mount(){
        $this->pageTitle = "Listado";
        $this->componentName = "Clientes";
    }
    public function render()
    {

       if(strlen($this->search) > 0)
        {
            $clients = Client::where('cedula','like','%'.$this->search.'%')->
            orWhere('nombre','like','%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $clients = Client::orderBy('id','desc')->paginate($this->pagination);
        }

            return view('livewire.client.clients',compact('clients'));
     }
     public function edit($id)
     {
         $client = Client::find($id,['id','cedula','nombre','image','apellido','rif','tipo_rif','email','cel','direccion','referencia','cel_referencia']);
         $this->cedula = $client->cedula;
         $this->nombre = $client->nombre;
         $this->selectedId = $client->id;
         $this->image = null;
         $this->apellido = $client->apellido;
         $this->tipo_rif = $client->tipo_rif;
         $this->rif = $client->rif;
         $this->email = $client->email;
         $this->cel = $client->cel;
         $this->direccion = $client->direccion;
         $this->referencia = $client->referencia;
         $this->cel_referencia = $client->cel_referencia;



         $this->emit('showModal');
        # return view('admin.roles.edit', compact('role', 'permissions'));
     }
     public function store(){
         $rules = [
             'cedula'=>'required|unique:clients|integer',
             'nombre'=>'required|max:255',
             'apellido'=>'required|max:255',
             'rif'=>'required|unique:clients',
             'email'=>'email',
             'cel' =>'required|max:50',
             'direccion'=>'required|max:255',
             'referencia' =>'max:255',
             'cel_referencia' =>'max:50',
             'image'=>'max:255',



        ];
         $messages = [
             'cedula.required'=>'Cedula es requerido',
             'cedula.unique'=>'Cedula ya existe',
             'nombre.required'=>'Nombre es requerido',
             'nombre.max'=>'Nombre debe ser máximo 255 carácteres',
             'apellido.required'=>'Apellido es requerido',
             'apellido.max'=>'Apellido debe ser máximo 255 carácteres',
             'rif.required'=>'Rif es requerido',
             'rif.unique'=>'Rif ya existe',
             'email.email'=>'Email debe tener un formato válido',
             'cel.required'=>'Celular es requerido',
             'cel.max'=>'Celular debe ser máximo 50 carácteres',
             'direccion.required'=>'Dirección es requerido',
             'direccion.max'=>'Dirección debe ser máximo 255 carácteres',
             'referencia.max'=>'Referencia debe ser máximo 255 carácteres',
             'cel_referencia.max'=>'Celular debe ser máximo 50 carácteres',
             'image.max'=>'Nombre de imagen debe ser máximo 255 carácteres',

        ];
        $this->validate($rules,$messages);
        $client = Client::create([
            'cedula'=>$this->cedula,
            'nombre'=>$this->nombre,
            'apellido'=>$this->apellido,
            'tipo_rif'=>$this->tipo_rif,
            'rif'=>$this->rif,
            'email'=>$this->email,
            'cel'=>$this->cel,
            'direccion'=>$this->direccion,
            'referencia'=>$this->referencia,
            'cel_referencia'=>$this->cel_referencia,

        ]);
        $customFileName;
        if($this->image){
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/clients',$customFileName);
            $client->image = $customFileName;
            $client->save();
        }

        $this->resetUI();
        $this->emit('client-added', 'Cliente Registrado');

     }
     public function resetUI(){
        $this->cedula= '';
        $this->image = null;
        $this->search = '';
        $this->selectedId=0;
        $this->nombre ='';
        $this->apellido='';
        $this->rif = '';
        $this->email = '';
        $this->cel = '';
        $this->direccion = '';
        $this->referencia = '';
        $this->cel_referencia ='';

     }
     public function update(){
        $rules = [
            'cedula'=>"required|unique:clients,cedula,{$this->selectedId}|integer",
            'nombre'=>'required|max:255',
            'apellido'=>'required|max:255',
            'rif'=>"required|unique:clients,rif,{$this->selectedId}",
            'email'=>'email',
            'cel' =>'required|max:50',
            'direccion'=>'required|max:255',
            'referencia' =>'max:255',
            'cel_referencia' =>'max:50',
            'image'=>'max:255',



       ];
        $messages = [
            'cedula.required'=>'Cedula es requerido',
            'cedula.unique'=>'Cedula ya existe',
            'nombre.required'=>'Nombre es requerido',
            'nombre.max'=>'Nombre debe ser máximo 255 carácteres',
            'apellido.required'=>'Apellido es requerido',
            'apellido.max'=>'Apellido debe ser máximo 255 carácteres',
            'rif.required'=>'Rif es requerido',
            'rif.unique'=>'Rif ya existe',
            'email.email'=>'Email debe tener un formato válido',
            'cel.required'=>'Celular es requerido',
            'cel.max'=>'Celular debe ser máximo 50 carácteres',
            'direccion.required'=>'Dirección es requerido',
            'direccion.max'=>'Dirección debe ser máximo 255 carácteres',
            'referencia.max'=>'Referencia debe ser máximo 255 carácteres',
            'cel_referencia.max'=>'Celular debe ser máximo 50 carácteres',
            'image.max'=>'Nombre de imagen debe ser máximo 255 carácteres',

       ];
       $this->validate($rules,$messages);
       $client = client::find($this->selectedId);
       $client->update([
        'cedula'=>$this->cedula,
        'nombre'=>$this->nombre,
        'apellido'=>$this->apellido,
        'tipo_rif'=>$this->tipo_rif,
        'rif'=>$this->rif,
        'email'=>$this->email,
        'cel'=>$this->cel != '',
        'direccion'=>$this->direccion,
        'referencia'=>$this->referencia,
        'cel_referencia'=>$this->cel_referencia,

        ]);
       if($this->image){
           $customFileName = uniqid().'_.'. $this->image->extension();
           $this->image->storeAs('public/clients',$customFileName);
           $imageToDelete = $client->image;
           $client->image = $customFileName;
           $client->save();
           if ($imageToDelete != null){
               if(file_exists('storage/clients/'.$imageToDelete)){
                   unlink('storage/clients/'.$imageToDelete);
               }
           }

       }
       $this->resetUI();
       $this->emit('client-updated','Cliente Actualizado');
    }
    public function destroy($id){
        $client = client::find($id);
        $imageToDelete = $client->image;
        $client->delete();
        if ($imageToDelete != null){
            if(file_exists('storage/clients/'.$imageToDelete)){
                unlink('storage/clients/'.$imageToDelete);
            }
        }
        $this->resetUI();
        $this->emit('client-delete','Cliente Eliminado');
    }
}