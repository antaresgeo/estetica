<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\Sucursal;
use App\User;
use App\ClienteTratamiento;
use App\Cliente;
use App\Tratamiento;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use \DateTime;
class ReservaController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->all());
        $reservas = Reserva::orderBy('id', 'ASC')
            ->whereBetween('start', [new DateTime($request->start), new DateTime($request->end)])
            ->where('estado', $request->estado)
            ->where('sucursal_id', $request->sucursal)
            ->get();

        foreach ($reservas as $reserva) {
            $ct = ClienteTratamiento::find($reserva->cliente_tratamiento_id);
            $c = Cliente::find($ct->cliente_id);
            $t = Tratamiento::find($ct->tratamiento_id);
            $reserva->cliente_id = $ct->cliente_id;
            $reserva->cliente = $c;
            $reserva->tratamiento_id = $ct->tratamiento_id;
            $reserva->title = ''.$t->nombre.'
            '.$c->nombre.' - '.$c->telefono.'
            Pago:'.$ct->abonado.' Impago:'.$ct->saldo.' Total:'.$ct->precio;
        }
        return $reservas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = [];
        foreach (Sucursal::all() as $sucursal) {
            $sucursales[$sucursal->id] = $sucursal->nombre;
        }

        $profecionales = [];
        foreach (User::all() as $user) {
            $profecionales[$user->id] = $user->name;
        }
        return view('reserva.create')
            ->with('sucursales', $sucursales)
            ->with('profecionales', $profecionales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reserva = new Reserva($request->all());
        $reserva->start = new DateTime($request->start);
        $reserva->end = new DateTime($request->end);
        $reserva->cliente_tratamiento_id = $request->cliente_tratamiento_id;
        $reserva->save();
        // flash('Tratamiento '. $trartamiento->nombre .' guardada con exito.')->success();
        // return redirect()->route('reserva.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        return view('reserva.edit')->with('reserva', $reserva);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reserva = Reserva::find($id);
        $reserva->start = $request->start;
        $reserva->end = $request->end;
        $reserva->sucursal_id = $request->sucursal_id;
        $reserva->user_id = $request->user_id;
        $reserva->estado = $request->estado;
        $reserva->cliente_tratamiento_id = $request->cliente_tratamiento_id;
        $reserva->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reserva::find($id)->delete();
    }

    public function editar(Request $rq, $rs)
    {
        $rs = Reserva::find($rs);
        $rs->start = $rq->start;
        $rs->end = $rq->end;
        $rs->save();
    }

    public function estado(Request $rq, Reserva $rs)
    {
        $rs = Reserva::find($rs);
        $rs->estado = $rq->estado;
        $rs->save();
    }
}
