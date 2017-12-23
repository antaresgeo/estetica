<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rotativo extends Model {

    protected  $table = "rotativo";

    protected $fillable = [
        'id',
        'sucursal_id',
        'tratamiento_id',
        'profesional',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo'
    ];

    public function sucursal(){
        return $this->belongsTo('App\Sucursal');
    }

    public function tratamiento(){
        return $this->belongsTo('App\Tratamiento');
    }
}
