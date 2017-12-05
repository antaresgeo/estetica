<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteTratamiento extends Model
{
    protected  $table = "cliente_tratamiento";

    public function reservas(){
        return $this->hasMany('App\Reserva');
    }

}
