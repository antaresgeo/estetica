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

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->all());
        $reservas = Reserva::orderBy('id', 'ASC')->paginate(10);
        foreach ($reservas as $reserva) {
            $ct = ClienteTratamiento::find($reserva->cliente_tratamiento_id);
            $c = Cliente::find($ct->cliente_id);
            $t = Tratamiento::find($ct->tratamiento_id);
            $reserva->cliente_id = $ct->cliente_id;
            $reserva->tratamiento_id = $ct->tratamiento_id;
            $reserva->title = ''.$c->nombre.'-'.$t->nombre;
            // $reserva->sucursal;
            // $reserva->user;
            // $reserva->ct = $ct;

        }
        return $reservas;
        // // view('reserva.list')->with('reservas', $reservas);
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
            ->with('profecionales', $profecionales);;
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
        // $reserva->save();
        // flash('Tratamiento '. $trartamiento->nombre .' guardada con exito.')->success();
        return redirect()->route('reserva.index');
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
    public function update(Request $request, Reserva $reserva)
    {
        // $reserva->nombre = $request->nombre;
        // $reserva->cantidad = $request->cantidad;
        // $reserva->precio = $request->precio;
        $reserva->save();
        // flash('Tratamiento '. $reserva->nombre .' guardada con exito.')->success();
        return redirect()->route('reserva.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        // flash('Tratamiento '. $tratamiento->nombre .' borrado con exito.')->success();
        return redirect()->route('reserva.index');
    }

    public function anyData()
    {
        return Datatables::of(Reserva::query())->make(true);
    }

    public function editar(Request $rq, Reserva $rs)
    {
      dd($rq->all());
    }

    public function cancelar(Request $rq, Reserva $rs)
    {
      dd($rq->all());
    }
}
