<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['cedula','nombre','apellido','tipo_rif','rif','email','cel','direccion','referencia','cel_referencia','image'];
    public function sales(){
        return $this->hasMany(Sales::class);
    }
    public function getImageAttribute($image){
        if($image == null)
            return "img-no-disponible.jpg";
        if(file_exists('storage/clients/'.$image))
            return $image;
        else
            return "img-no-disponible.jpg";
    }
}