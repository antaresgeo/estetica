<?php

namespace App\Http\Controllers;

use App\Sucursal;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class SucursalController extends Controller
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
        $sucursales = Sucursal::orderBy('id', 'ASC')->paginate(10);
        return view('sucursal.list')->with('sucursales', $sucursales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sucursal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sucursal = new Sucursal($request->all());
        $sucursal->save();
        flash('Sucursal '. $sucursal->nombre .' guardada con exito.')->success();
        return redirect()->route('sucursal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursal)
    {
        return view('sucursal.edit')->with('sucursal', $sucursal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        $sucursal->nombre = $request->nombre;
        $sucursal->save();
        flash('Sucursal '. $sucursal->nombre .' guardada con exito.')->success();
        return redirect()->route('sucursal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
        Sucursal::find($id)->delete();
        flash('Sucursal borrada con exito.')->success();
        return redirect()->route('sucursal.index');
    }

    public function anyData()
    {
        return Datatables::of(Sucursal::query())->make(true);
    }
}
