<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ClienteController extends Controller
{
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
        $cliente->save();
        flash('Cliente '. $cliente->nombre .' guardado con exito.')->success();
        return redirect()->route('cliente.index');
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
    public function destroy(Cliente $cliente)
    {
        $cliente->forceDelete();
        flash('Cliente '. $cliente->nombre .' borrado con exito.')->success();
        return redirect()->route('cliente.index');
    }

    public function anyData()
    {
        return Datatables::of(Cliente::query())->make(true);
    }
}
