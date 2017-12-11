<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Reserva;
use App\Tratamiento;
use App\Sucursal;
use App\User;
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
        $tratamientos = [];
        foreach (Tratamiento::all() as $tratamiento) {
            $tratamientos[$tratamiento->id] = $tratamiento->nombre;
        }
        $sucursales = [];
        foreach (Sucursal::all() as $sucursal) {
            $sucursales[$sucursal->id] = $sucursal->nombre;
        }
        $profesionales = [];
        foreach (User::all() as $user) {
            $profesionales[$user->id] = $user->name;
        }
        return view('home')
            ->with('sucursales', $sucursales)
            ->with('tratamientos', $tratamientos)
            ->with('profesionales', $profesionales);
    }
}
