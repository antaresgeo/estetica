<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected  $table = "cliente";

    protected $fillable = [ 'nombre', 'telefono', 'identificacion' ];

    public function tratamientos(){
        return $this->belongsToMany('App\Tratamiento')
            ->withPivot('id','catidad', 'precio', 'abonado', 'saldo')
            ->withTimestamps();
            // ->using('App\ClienteTratamiento');
    }

}
