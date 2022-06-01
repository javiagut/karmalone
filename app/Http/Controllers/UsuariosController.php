<?php

namespace App\Http\Controllers;

use App\Models\Fichaje;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UsuariosController extends Controller
{
    public function verUsuarios(){

        $usuarios = User::paginate(10);

        $rol = User::find(Auth::id())->rol;
        $hoy = Carbon::today()->format('Y-m-d');
        return view('usuarios',compact('rol','usuarios','hoy'));
    
    }

    public function usuario($id,$fecha){
        if(!isset($fecha) && !request('fecha')) $fecha = Carbon::today();
        else if (!isset($fecha)) $fecha=request('fecha');
        $rol = User::find(Auth::id())->rol;
        $usuario = User::find($id);
        $fichajes = Fichaje::where('id_user','=',$id)->where('created_at','>',Carbon::parse($fecha))->where('created_at','<',Carbon::parse($fecha)->addDay())->orderBy('created_at')->get();
        return view('usuario',compact('usuario','rol','fichajes','fecha'));
    }
    static function fechaFormat(Carbon $fecha){
        return $fecha->format('H:i');
    }
}
