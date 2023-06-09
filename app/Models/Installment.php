<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['expiration_date','amount','estado','credit_id'];
    public function credit(){
        return $this->belongsTo(Credit::class);
    }
    public function paymentsInstallment(){
        return $this->hasMany(PaymentInstallment::class);
    }
}