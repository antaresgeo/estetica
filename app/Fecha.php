<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Fecha extends Model {

    protected  $table = "fecha";

    protected $fillable = [
        'fecha'
    ];

    public function rotativo(){
        return $this->belongsTo('App\Rotativo');
    }
}
