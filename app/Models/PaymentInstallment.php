<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentInstallment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['amount_paid','installment_id'];
    public function installment(){
        return $this->belongsTo(Installment::class);
    }
}