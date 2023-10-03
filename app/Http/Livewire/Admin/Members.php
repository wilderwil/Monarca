<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Member;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Members extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search, $image, $selectedId, $pageTitle, $componentName;
    public $cedula, $nombre, $apellido, $tipo_rif, $status, $cel, $saldo, $email, $member_type, $titulo, $accion;
    private $pagination = 10;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->pageTitle = "Listado";
        $this->componentName = "Socios";
    }
    public function render()
    {

        if (strlen($this->search) > 0) {
            /* $socios = Member::where('cedula', 'like', '%' . $this->search . '%')->
            orWhere('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);*/
            $socios = Member::where('cedula', '=', $this->search)->
                orWhere('name', '=', $this->search)->paginate($this->pagination);
        } else {
            #$socios = Member::orderBy('id', 'desc')->paginate($this->pagination);
            $socios = [];
        }

        return view('livewire.member.members', compact('socios'));
    }

    public function edit($id)
    {
        $client = Member::find($id, ['id', 'cedula', 'name', 'last_name', 'email', 'member_type', 'saldo', 'status', 'cel', 'member_type', 'accion']);
        $this->cedula = $client->cedula;
        $this->nombre = $client->name;
        $this->apellido = $client->last_name;
        $this->selectedId = $client->id;
        #$this->image = null;
        $this->status = $client->status;
        $this->saldo = $client->saldo;
        $this->email = $client->email;
        $this->titulo = $client->title;
        $this->cel = $client->cel;
        $this->member_type = $client->member_type;
        $this->accion = $client->accion;



        $this->emit('showModal');
        # return view('admin.roles.edit', compact('role', 'permissions'));
    }
    public function store()
    {
        $rules = [
            'cedula' => 'required|unique:clients|integer',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'status' => 'max:50',
            'titulo' => 'max:50',
            'email' => 'email',
            'cel' => 'required|max:20',
            'member_type' => 'required|max:20',
            'accion' => 'required|max:10'




        ];
        $messages = [
            'cedula.required' => 'Cedula es requerido',
            'cedula.unique' => 'Cedula ya existe',
            'nombre.required' => 'Nombre es requerido',
            'nombre.max' => 'Nombre debe ser máximo 255 carácteres',
            'apellido.required' => 'Apellido es requerido',
            'apellido.max' => 'Apellido debe ser máximo 255 carácteres',
            'status.max' => 'Estatus máximo 50 carácteres',
            'email.email' => 'Email debe tener un formato válido',
            'cel.required' => 'Celular es requerido',
            'cel.max' => 'Celular debe ser máximo 20 carácteres',
            'direccion.required' => 'Dirección es requerido',
            'direccion.max' => 'Dirección debe ser máximo 255 carácteres',
            'member_type.required' => 'Tipo socio es requerido',
            'accion.required' => 'Codigo de la Acción es requerido',
            'accion.max' => 'Código debe ser máximo de 10 carácteres'

        ];
        $this->validate($rules, $messages);
        $socio = Member::create([
            'cedula' => $this->cedula,
            'name' => $this->nombre,
            'last_name' => $this->apellido,
            'status' => $this->status,
            'title' => $this->titulo,
            'email' => $this->email,
            'cel' => $this->cel,
            'member_type' => $this->member_type,
            # 'saldo' => $this->saldo,
            'accion' => $this->accion,

        ]);
        /* $customFileName;
        if ($this->image) {
        $customFileName = uniqid() . '_.' . $this->image->extension();
        $this->image->storeAs('public/clients', $customFileName);
        $client->image = $customFileName;
        $client->save();
        }*/

        $this->resetUI();
        $this->emit('client-added', 'Socio Registrado');

    }
    public function resetUI()
    {
        $this->cedula = '';
        #$this->image = null;
        $this->search = '';
        $this->selectedId = 0;
        $this->nombre = '';
        $this->apellido = '';
        $this->status = '';
        $this->email = '';
        $this->cel = '';
        $this->saldo = '';
        $this->status = '';
        $this->member_type = '';
        $this->accion = '';

    }
    public function update()
    {
        $rules = [
            'cedula' => "required|unique:members,cedula,{$this->selectedId}|integer",
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'email',
            'cel' => 'required|max:50',
            'titulo' => 'required|max:255',
            'status' => 'max:50',
            'member_type' => 'required|max:20',
            'accion' => 'required|max:10'

        ];
        $messages = [
            'cedula.required' => 'Cedula es requerido',
            'cedula.unique' => 'Cedula ya existe',
            'nombre.required' => 'Nombre es requerido',
            'nombre.max' => 'Nombre debe ser máximo 255 carácteres',
            'apellido.required' => 'Apellido es requerido',
            'apellido.max' => 'Apellido debe ser máximo 255 carácteres',
            'status.max' => 'Estatus máximo 50 carácteres',
            'email.email' => 'Email debe tener un formato válido',
            'cel.required' => 'Celular es requerido',
            'cel.max' => 'Celular debe ser máximo 20 carácteres',
            'direccion.required' => 'Dirección es requerido',
            'direccion.max' => 'Dirección debe ser máximo 255 carácteres',
            'member_type.required' => 'Tipo socio es requerido',
            'accion.required' => 'Codigo de la Acción es requerido',
            'accion.max' => 'Código debe ser máximo de 10 carácteres'

        ];
        $this->validate($rules, $messages);
        $client = Member::find($this->selectedId);
        $client->update([
            'cedula' => $this->cedula,
            'name' => $this->nombre,
            'last_name' => $this->apellido,
            'status' => $this->status,
            'title' => $this->titulo,
            'email' => $this->email,
            'cel' => $this->cel != '',
            'member_type' => $this->member_type,
            # 'saldo' => $this->saldo,
            'accion' => $this->accion

        ]);
        /*if ($this->image) {
        $customFileName = uniqid() . '_.' . $this->image->extension();
        $this->image->storeAs('public/clients', $customFileName);
        $imageToDelete = $client->image;
        $client->image = $customFileName;
        $client->save();
        if ($imageToDelete != null) {
        if (file_exists('storage/clients/' . $imageToDelete)) {
        unlink('storage/clients/' . $imageToDelete);
        }
        }
        }*/
        $this->resetUI();
        $this->emit('client-updated', 'Socio Actualizado');
    }
    public function destroy($id)
    {
        $socio = Member::find($id);
        # $imageToDelete = $client->image;
        $socio->delete();
        /* if ($imageToDelete != null) {
        if (file_exists('storage/clients/' . $imageToDelete)) {
        unlink('storage/clients/' . $imageToDelete);
        }
        }*/
        $this->resetUI();
        $this->emit('client-delete', 'Socio Eliminado');
    }
}