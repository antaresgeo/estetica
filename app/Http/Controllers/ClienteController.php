<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Tratamiento;
use App\ClienteTratamiento;
use \DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;

class ClienteController extends Controller
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
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'ASC')->paginate(10);
        return view('cliente.list')->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente($request->all());
        $cliente->fecha_nacimiento = new DateTime($request->facha_nacimiento);
        $cliente->save();
        flash('Cliente '. $cliente->nombre .' guardado con exito.')->success();
        if(!$request->noreload){
            return redirect()->route('cliente.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit')->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->nombre = $request->nombre;
        $cliente->telefono = $request->telefono;
        $cliente->identificacion = $request->identificacion;
        $cliente->email = $request->email;
        // $cliente->localidad = $request->localidad;
        $cliente->fecha_nacimiento = new DateTime($request->facha_nacimiento);
        // $cliente->ocupacion = $request->ocupacion;
        $cliente->save();
        flash('Cliente '. $cliente->nombre .' guardado con exito.')->success();
        return redirect()->route('cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        flash('Cliente  borrado con exito.')->success();
        return redirect()->route('cliente.index');
    }

    public function anyData()
    {
        return Datatables::of(Cliente::query())->make(true);
    }

    public function addTratamiento(Request $r)
    {
        $t = Tratamiento::find($r->t);
        $t->clientes()->attach($r->c, [
            'catidad' => $t->cantidad,
            'precio' => $t->precio,
            'abonado' => 0,
            'saldo' => $t->precio
        ]);
        // flash('Tratamiento asignado')->success();
        $res = $t->clientes()
            ->wherePivot('tratamiento_id', $t->id)
            ->orderBy('pivot_created_at', 'desc')
            ->first();
        $res->pivot->tratamiento_rotativo = $t->rotativo;
        return $res;
    }

    public function buscar(Request $r)
    {
        return Cliente::where('nombre','LIKE',"%{$r->sh}%")->get();
    }

    public function tratamientos($id)
    {
        $c = Cliente::find($id);
        return $c->tratamientos;
    }

    public function saldo($id)
    {
        $saldo = 0;
        $abonado = 0;
        $precio = 0;
        $t = Cliente::find($id)->tratamientos;
        foreach ($t as $tt) {
            $ct = ClienteTratamiento::find($tt->pivot->id);
            $saldo = $saldo + $ct->saldo;
            $abonado = $abonado + $ct->abonado;
            $precio = $precio + $ct->precio;
        }
        return [ 'saldo' => $saldo, 'abonado' => $abonado, 'precio' => $precio ];
    }

    public function abonar(Request $r, $id)
    {
        $ct = ClienteTratamiento::find($id);
        if($ct->saldo === 0){
            return response('El valor del tratamiento ya ha sido cancelado.', 400);
        }
        if($r->valor > $ct->saldo ){
            return response('El valor a abonar es mayor que el del tratamiento ('.$ct->saldo.')', 400);
        }
        $ct->abonado = $ct->abonado + $r->valor;
        $ct->saldo = $ct->saldo - $r->valor;
        $ct->save();
    }
}
