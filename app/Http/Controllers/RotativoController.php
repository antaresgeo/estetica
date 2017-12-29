<?php

namespace App\Http\Controllers;

use App\Tratamiento;
use App\Sucursal;
use App\Rotativo;
use App\Fecha;
use App\ClienteTratamiento;
use \DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;

class RotativoController extends Controller
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
        return view('rotativo.list');
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
        $tratamientos = [];
        foreach (Tratamiento::where('rotativo', true)->get() as $tratamiento) {
            $tratamientos[$tratamiento->id] = $tratamiento->nombre.' (Rotativo)';
        }
        return view('rotativo.create')
            ->with('sucursales', $sucursales)
            ->with('tratamientos', $tratamientos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rotativo = new Rotativo($request->all());
        $rotativo->save();
        foreach (explode(",",$request->fechas) as $val_fecha) {
            $fecha = new Fecha();
            $fecha->rotativo_id = $rotativo->id;
            $fecha->fecha = new DateTime($val_fecha);
            $fecha->save();
        }
        flash('Guardado con exito.')->success();
        if(!$request->noreload){
            return redirect()->route('rotativo.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rotativo  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Rotativo $rotativo){}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rotativo  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Rotativo $rotativo)
    {
        $sucursales = [];
        foreach (Sucursal::all() as $sucursal) {
            $sucursales[$sucursal->id] = $sucursal->nombre;
        }
        $tratamientos = [];
        foreach (Tratamiento::where('rotativo', true)->get() as $tratamiento) {
            $tratamientos[$tratamiento->id] = $tratamiento->nombre.' (Rotativo)';
        }
        foreach ($rotativo->fechas as $key => $fecha) {
            $rotativo->val_fechas = $rotativo->val_fechas.($key>0?',':'').$fecha->fecha;
        }
        // dd($rotativo->val_fechas);
        return view('rotativo.edit')
            ->with('rotativo', $rotativo)
            ->with('sucursales', $sucursales)
            ->with('tratamientos', $tratamientos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rotativo  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rotativo $rotativo)
    {
        $rotativo->tratamiento_id = $request->tratamiento_id;
        $rotativo->sucursal_id = $request->sucursal_id;
        $rotativo->profesional = $request->profesional;
        $rotativo->fechas()->delete();
        foreach (explode(",",$request->fechas) as $val_fecha) {
            $fecha = new Fecha();
            $fecha->rotativo_id = $rotativo->id;
            $fecha->fecha = new DateTime($val_fecha);
            $fecha->save();
        }
        $rotativo->save();
        flash('Guardado con exito.')->success();
        return redirect()->route('rotativo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rotativo  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rotativo::find($id)->delete();
        flash('Rotativo  borrado con exito.')->success();
        return redirect()->route('rotativo.index');
    }

    public function anyData()
    {
        return Datatables::of(Rotativo::query())
            ->addColumn('sucursal_nombre', function (Rotativo $rotativo) {
                return $rotativo->sucursal->nombre;
            })
            ->addColumn('fechas', function (Rotativo $rotativo) {
                $res = '';
                foreach ($rotativo->fechas as $key => $fecha) {
                    $res = $res.($key>0?',':'').$fecha->fecha;
                }
                return $res;
            })
            ->addColumn('tratatamiento_nombre', function (Rotativo $rotativo) {
                return $rotativo->tratamiento->nombre;
            })->make(true);
    }


    public function valid($sucursal_id, $cliente_tratamiento_id)
    {
        $cliente_tratamiento = ClienteTratamiento::find($cliente_tratamiento_id);
        $tratamiento = Tratamiento::find($cliente_tratamiento->tratamiento_id);
        if($tratamiento->rotativo){
            $rotativos = Rotativo::where([
                ['tratamiento_id', '=', $tratamiento->id],
                ['sucursal_id', '=', $sucursal_id]
            ])->get();
            dd($rotativo);
            if(count($rotativos) > 0){
                $days = [];
                foreach ($rotativos as $rotativo) {
                    $days = $this->findDates($rotativo->fechas,  $days);
                }
                return ['res' => true, 'data' => $days];
            }
        }
        return ['res'  => false ];
    }
    private function findDates($dates,  $array)
    {
        foreach ($dates as $date) {
            if(!in_array($date->fecha, $array)){
                array_push($array, $date->fecha);
            }
        }
        return $array;
    }
}
