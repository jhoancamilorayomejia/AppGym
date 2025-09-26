<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment'; // 👈 asegúrate de que coincida con tu BD
    protected $primaryKey = 'idpay';
    public $timestamps = false;

    protected $fillable = [
        'iduser',
        'typeplan',
        'price',
        'datepay',
        'datestart',
        'datefinish',
        'estado',
    ];
}

