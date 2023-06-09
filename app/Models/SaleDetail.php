<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['price','quantity','product_id','sale_id'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function sale(){
        return $this->belongsTo(Sale::class);
    }
}
