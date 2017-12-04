<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected  $table = "reserva";

    protected $fillable = [
        'hora', 'tratatamiento_cliente_id', 'sucursal_id', 'user_id', 'estado'
    ];

     public function user(){
         return $this->belongsTo('App\User');
     }

     public function sucursal(){
         return $this->belongsTo('App\Sucursal');
     }

     public function cliente_tratatamiento(){
         return $this->belongsTo('App\ClienteTratamiento');
     }
}
