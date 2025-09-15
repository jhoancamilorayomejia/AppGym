<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer'; // nombre exacto de tu tabla

    protected $primaryKey = 'idcustomer'; // clave primaria

    public $timestamps = false; // desactiva timestamps si no tienes created_at y updated_at

    protected $fillable = [
        'cedula',
        'name',
        'lastname',
        'phone',
        'email',
    ];
}
