<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class usuario extends Model
{
    protected $fillable = ['cod_grupos', 'cod_grupos', 'login', 'senha', 'nome', 'email', 'situacao'];
    protected $guarded = ['cod_usuario'];
    protected $table = 'usuarios_pdv';
    public $timestamps = false;
    protected $primaryKey = 'cod_usuario';
}
