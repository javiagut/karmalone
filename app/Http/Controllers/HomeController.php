<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichaje;
use App\Models\Motivo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $user = User::find(Auth::id());
        if($user->rol == 'Trabajador'){
            if(!isset($fecha) && !request('fecha')) $fecha = Carbon::today();
            else if (!isset($fecha)) $fecha=request('fecha');
            if (count(Fichaje::fichajesHoy($fecha)) == 0 || count(Fichaje::fichajesHoy($fecha))%2 == 0) {
                # Acción Entrar
                $accion='Entrar';
            }
            else{
                # Acción Salir
                $accion='Salir';
            }
            $motivos = Motivo::all();
            $fichajes = Fichaje::fichajesHoy($fecha);
            $tiempoTrabajado = Fichaje::tiempoTrabajado($fecha);
            $fecha = Carbon::parse($fecha)->format('Y-m-d');
            return view('home',compact('accion','fichajes','tiempoTrabajado','fecha','motivos'));
        }
        else if ($user->rol == 'RRHH'){
            return view('rrhh');
        }
    }
}
