<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Reserva;
use App\ClienteTratamiento;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $c = Cliente::find(1);

        // $r = new Reserva();
        // $r->sucursal_id = 1;
        // $r->user_id = 1;
        // $r->cliente_tratamiento_id = 4;
        // $r->hora = date("Y-m-d H:i:s");
        // $r->save();

        // $r = Reserva::find(1);
        // ClienteTratamiento::find($r->cliente_tratamiento_id)
        // dd($c->tratamientos);
        // $c->tratamientos()->attach(1, ['catidad'=> 5, 'precio' => 500, 'abonado' => 0, 'saldo' => 500]);

        // foreach ($c->tratamientos as $tratamiento) {
        //     echo $tratamiento->pivot->id;
        //     echo $tratamiento->nombre;
        //     echo $tratamiento->pivot->created_at;
        //     echo '<br/>';
        // }

        // $pivot_id = $c->tratamientos()->where('tratamiento.id', '=', 1)->withPivot("id")->orderBy('pivot_created_at', 'desc')->first()->pivot->id;
        // echo $pivot_id;
        return view('home');
    }
}
