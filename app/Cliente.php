<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected  $table = "cliente";

    protected $fillable = [
        'id',
        'nombre',
        'telefono',
        'identificacion',
        'email',
        'localidad',
        'fecha_nacimiento',
        'ocupacion'
    ];

    public function tratamientos(){
        return $this->belongsToMany('App\Tratamiento')
            ->withPivot('id','catidad', 'precio', 'abonado', 'saldo')
            ->withTimestamps();
    }
}
