<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;
    protected $fillable = ['expiration_date','amount','estado','credit_id'];
    public function credit(){
        return $this->belongsTo(Credit::class);
    }
}