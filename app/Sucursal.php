<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected  $table = "sucursal";

    protected $fillable = [ 'nombre' ];

    public function reservas(){
        return $this->hasMany('App\Reserva');
    }

    public function rotativos(){
        return $this->hasMany('App\Reserva');
    }
}
