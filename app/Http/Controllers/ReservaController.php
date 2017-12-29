<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\Sucursal;
use App\User;
use App\ClienteTratamiento;
use App\Cliente;
use App\Tratamiento;
use App\Rotativo;
use App\Http\Controllers\RotativoController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use \DateTime;
use \DateInterval;
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
        $reservas = Reserva::orderBy('id', 'ASC');
        if($request->start and $request->end){
            $reservas = $reservas->whereBetween('start', [new DateTime($request->start), new DateTime($request->end)]);
        }
        if($request->estado and $request->estado != 'todas'){
            $reservas = $reservas->where('estado', $request->estado);
        }
        if($request->sucursal){
            $reservas = $reservas->where('sucursal_id', $request->sucursal);
        }
        $reservas = $reservas->get();

        foreach ($reservas as $reserva) {
            $ct = ClienteTratamiento::find($reserva->cliente_tratamiento_id);
            $c = Cliente::find($ct->cliente_id);
            $t = Tratamiento::find($ct->tratamiento_id);
            $reserva->cliente_id = $ct->cliente_id;
            $reserva->cliente = $c;
            $reserva->tratamiento_id = $ct->tratamiento_id;
            $reserva->tratamiento_nombre = $t->nombre;
            $reserva->title = ''.$t->nombre.'
            '.$c->nombre.' - '.$c->telefono.'
            Pago:'.$ct->abonado.' Impago:'.$ct->saldo.' Total:'.$ct->precio;
            if($t->rotativo){
                $reserva->rotativo = true;
                $reserva->valid_days = $this->valid($reserva->sucursal_id, $reserva->cliente_tratamiento_id);
            }else{
                $reserva->rotativo = false;
            }
        }
        return $reservas;
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
            if(count($rotativos) > 0){
                $days = [];
                foreach ($rotativos as $rotativo) {
                    $days = $this->findDates($rotativo->fechas,  $days);
                }
                return $days;
            }
        }
        return [];
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
        $ct = ClienteTratamiento::find($request->cliente_tratamiento_id);
        $tt = Tratamiento::find($ct->tratamiento_id);
        if($ct->saldo === 0){
            return response('El valor del tratamiento ya ha sido cancelado.', 400);
        }
        if($request->valor > $ct->saldo ){
            return response('El valor a abonar es mayor que el del tratamiento ('.$ct->saldo.')', 400);
        }
        if($ct->abonado <= $ct->saldo){
            $ct->abonado = $ct->abonado + $request->valor;
            $ct->saldo = $ct->saldo - $request->valor;
        }
        $reserva = new Reserva($request->all());
        $date = $request->start1.' '.$request->start2;
        $reserva->start = new DateTime($date);
        $end = new DateTime($date);
        $reserva->end = $end->add(new DateInterval('PT' . $tt->duracion . 'M'));
        $reserva->cliente_tratamiento_id = $request->cliente_tratamiento_id;
        $reserva->save();
        $ct->save();
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
        $ct = ClienteTratamiento::find($request->cliente_tratamiento_id);
        $tt = Tratamiento::find($ct->tratamiento_id);
        $date = $request->start1.' '.$request->start2;
        $reserva->start = new DateTime($date);
        $end = new DateTime($date);
        $reserva->end = $end->add(new DateInterval('PT' . $tt->duracion . 'M'));
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
