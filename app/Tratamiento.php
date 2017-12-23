<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected  $table = "tratamiento";



    protected $fillable = [ 'nombre', 'cantidad', 'precio', 'duracion', 'rotativo' ];

    public function clientes(){
        return $this->belongsToMany('App\Cliente')
            ->withPivot('id','catidad', 'precio', 'abonado', 'saldo')
            ->withTimestamps();
            // ->using('App\ClienteTratamiento');
    }

    public function rotativoFn()
    {
        return $this->hasOne('App\Rotativo');
    }
}
