<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment'; // tu tabla en la BD
    protected $primaryKey = 'idpay'; // tu PK

    protected $fillable = [
        'idcliente',
        'typeplan',
        'price',
        'datepay',
        'datestart',
        'datefinish',
        'estado'
    ];

    public $timestamps = false; // si no tienes created_at y updated_at
}
