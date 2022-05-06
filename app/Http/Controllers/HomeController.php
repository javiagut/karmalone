<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichaje;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (count(Fichaje::preguntarFichar()) == 0 || count(Fichaje::preguntarFichar())%2 == 0) {
            # Acción Entrar
            $accion='Entrar';
        }
        else{
            # Acción Salir
            $accion='Salir';
        }
        $fichajes = Fichaje::fichajesHoy();
        return view('home',compact('accion','fichajes'));
    }
}
