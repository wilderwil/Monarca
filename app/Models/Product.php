<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'cost',
        'price',
        'stock',
        'alert',
        'size',
        'color',
        'placa',
        'features',
        'category_id',

    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
        public function getImageAttribute($image){
        if($image == null)
            return "img-no-disponible.jpg";
        if(file_exists('storage/products/'.$image))
            return $image;
        else
            return "img-no-disponible.jpg";
    }
}