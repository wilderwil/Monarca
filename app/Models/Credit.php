<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credit extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['installments_quantity','total_amount','venta_id'];
    public function installments(){
        return $this->hasMany(Installment::class);
    }
    public function sales(){
        return $this->hasMany(Sale::class);
    }
}