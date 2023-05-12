<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Categories extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $search, $image, $selectedId, $pageTitle, $componentName;
    private $pagination = 3;
    protected $paginationTheme ='bootstrap';
        public function mount(){
        $this->pageTitle = "Listado";
        $this->componentName = "Categorias";
    }
    public function render()
    {

       if(strlen($this->search) > 0)
        {
            $categories = Category::where('name','like','%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $categories = Category::orderBy('id','desc')->paginate($this->pagination);
        }
            return view('livewire.category.categories',compact('categories'));
     }
     public function edit($id)
     {
         $category = Category::find($id,['id','name','image']);
         $this->name = $category->name;
         $this->selectedId = $category->id;
         $this->image = null;
         $this->emit('showModal');
        # return view('admin.roles.edit', compact('role', 'permissions'));
     }
     public function store(){
         $rules = [
             'name'=>'required|unique:categories|min:3'
        ];
         $messages = [
             'name.required'=>'Nombre de categoria es requerido',
             'name.unique'=>'Nombre de categoria ya existe',
             'name.min'=>'Nombre de la categoria debe tener al menos 3 carácteres'
        ];
        $this->validate($rules,$messages);
        $category = Category::create(['name'=>$this->name]);
        $customFileName;
        if($this->image){
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/categories',$customFileName);
            $category->image = $customFileName;
            $category->save();
        }
        $this->resetUI();
        $this->emit('category-added', 'Categoria Registrada');

     }
     public function resetUI(){
        $this->name= '';
        $this->image = null;
        $this->search = '';
        $this->selectedId=0;
     }
     public function update(){
        $rules = [
            'name'=>"required|unique:categories,name,{$this->selectedId}|min:3"
       ];
        $messages = [
            'name.required'=>'Nombre de categoria es requerido',
            'name.unique'=>'Nombre de categoria ya existe',
            'name.min'=>'Nombre de la categoria debe tener al menos 3 carácteres'
       ];
       $this->validate($rules,$messages);
       $category = Category::find($this->selectedId);
       $category->update(['name'=>$this->name]);
       if($this->image){
           $customFileName = uniqid().'_.'. $this->image->extension();
           $this->image->storeAs('public/categories',$customFileName);
           $imageToDelete = $category->image;
           $category->image = $customFileName;
           $category->save();
           if ($imageToDelete != null){
               if(file_exists('storage/categories/'.$imageToDelete)){
                   unlink('storage/categories/'.$imageToDelete);
               }
           }

       }
       $this->resetUI();
       $this->emit('category-updated','Categoria Actualizada');
    }
    public function destroy($id){
        $category = Category::find($id);
        $imageToDelete = $category->image;
        $category->delete();
        if ($imageToDelete != null){
            if(file_exists('storage/categories/'.$imageToDelete)){
                unlink('storage/categories/'.$imageToDelete);
            }
        }
        $this->resetUI();
        $this->emit('category-delete','Categoria Eliminada');
    }
}