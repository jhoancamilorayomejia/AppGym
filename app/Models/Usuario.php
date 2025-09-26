<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; // Nombre de la tabla

    protected $primaryKey = 'iduser'; // Llave primaria

    public $timestamps = false; // Tu tabla no tiene created_at / updated_at

    protected $fillable = [
        'cedula',
        'name',
        'lastname',
        'address',
        'phone',
        'email',
        'username',
        'password',
        'usertipo',
    ];
}
