<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'cedula',
        'name',
        'last_name',
        'title',
        'email',
        'member_type',
        'saldo',
        'status',
        'cel',
        'accion'

    ];

}
