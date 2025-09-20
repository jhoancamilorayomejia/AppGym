<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; // Nombre de la tabla

    protected $primaryKey = 'iduser'; // Llave primaria

    public $timestamps = false; // Si tu tabla NO usa created_at/updated_at

    protected $fillable = [
        'username',
        'password',
        'usertipo',
    ];
}
