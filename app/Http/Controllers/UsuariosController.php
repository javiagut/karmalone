<?php

namespace App\Http\Controllers;

use App\Models\Ausencia;
use Illuminate\Support\Facades\Hash;
use App\Models\Fichaje;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UsuariosController extends Controller
{
    public function verUsuarios(){

        $usuarios = User::orderBy('apellido1')->paginate(10);
        $ausencias = Ausencia::all();
        $rol = User::find(Auth::id())->rol;
        $hoy = Carbon::today()->format('Y-m-d');
        return view('usuarios',compact('rol','usuarios','hoy','ausencias'));
    
    }

    public function usuario($id,$fecha){
        if(!isset($fecha) && !request('fecha')) $fecha = Carbon::today();
        else if (!isset($fecha)) $fecha=request('fecha');
        $rol = User::find(Auth::id())->rol;
        $usuario = User::find($id);
        $fichajes = Fichaje::where('id_user','=',$id)->where('created_at','>',Carbon::parse($fecha))->where('created_at','<',Carbon::parse($fecha)->addDay())->orderBy('created_at')->get();
        $ausencias = Ausencia::where('id_user','=',$id)->where('fecha','=',$fecha)->get();
        return view('usuario',compact('usuario','rol','fichajes','fecha','ausencias'));
    }
    static function fechaFormat(Carbon $fecha){
        return $fecha->format('H:i');
    }
    public function actualizarUsuario($id){
        $usuario = User::find($id);
        $usuario->update([
            'nombre' => request('name'),
            'apellido1' => request('apellido1'),
            'apellido2' => request('apellido2'),
            'contacto1' => request('contacto1'),
            'contacto2' => request('contacto2'),
            'nacimiento' => request('nacimiento'),
            'rol' => request('rol'),
        ]);
        return back()->with('status','Se ha actualizado correctamente');
    }

    public function eliminarUsuario($id){

        Ausencia::where('id_user','=',$id)->delete();
        Fichaje::where('id_user','=',$id)->delete();
        $usuario = User::find($id)->delete();

        return back()->with('status','Se ha eliminado el usuario correctamente');
    }
    public function nuevoUsuario(){
        User::create([
            'nombre' => request('name'),
            'apellido1' => request('apellido1'),
            'apellido2' => request('apellido2'),
            'contacto1' => request('contacto1'),
            'contacto2' => request('contacto2'),
            'nacimiento' => request('nacimiento'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'rol' => request('rol')
        ]);
        return back()->with('status','Se ha creado el usuario correctamente');
    }
}
