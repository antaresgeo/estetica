<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rotativo extends Model {

    protected  $table = "rotativo";

    protected $fillable = [
        'id',
        'sucursal_id',
        'tratamiento_id',
        'profesional'
    ];

    public function fechas(){
        return $this->hasMany('App\Fecha');
    }

    public function sucursal(){
        return $this->belongsTo('App\Sucursal');
    }

    public function tratamiento(){
        return $this->belongsTo('App\Tratamiento');
    }
}
