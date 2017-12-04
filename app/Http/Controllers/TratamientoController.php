<?php

namespace App\Http\Controllers;

use App\Tratamiento;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tratamientos = Tratamiento::orderBy('id', 'ASC')->paginate(10);
        return view('tratamiento.list')->with('tratamientos', $tratamientos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tratamiento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trartamiento = new Tratamiento($request->all());
        $trartamiento->save();
        flash('Tratamiento '. $trartamiento->nombre .' guardada con exito.')->success();
        return redirect()->route('tratamiento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Tratamiento $tratamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Tratamiento $tratamiento)
    {
        return view('tratamiento.edit')->with('tratamiento', $tratamiento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tratamiento $tratamiento)
    {
        $tratamiento->nombre = $request->nombre;
        $tratamiento->cantidad = $request->cantidad;
        $tratamiento->precio = $request->precio;
        $tratamiento->save();
        flash('Tratamiento '. $tratamiento->nombre .' guardada con exito.')->success();
        return redirect()->route('tratamiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
     public function destroy(Tratamiento $tratamiento)
     {
         $tratamiento->delete();
         flash('Tratamiento '. $tratamiento->nombre .' borrado con exito.')->success();
         return redirect()->route('tratamiento.index');
     }

     public function anyData()
     {
         return Datatables::of(Tratamiento::query())->make(true);
     }
}
