<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios'; // nombre de la tabla en tu BD

    protected $primaryKey = 'id'; // clave primaria

    public $timestamps = false; // tu tabla no tiene created_at/updated_at

    protected $fillable = [
        'username',
        'password',
        'usertipo',
    ];

    protected $hidden = [
        'password',
    ];
}
