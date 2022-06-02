<?php

namespace App\Http\Controllers;

use App\Models\Ausencia;
use App\Models\Motivo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MotivoController extends Controller
{
    public function RRHH(){
        $motivos = Motivo::orderBy('created_at','ASC')->orderBy('descripcion','ASC')->get();
        $rol = User::find(Auth::id())->rol;
        $hoy = Carbon::today()->format('Y-m-d');
        return view('rrhh',compact('rol','motivos','hoy',));
    }
    public function actualizarMotivo($motivo){
        Motivo::find($motivo)->update([
            'descripcion' => request('descripcion')
        ]);
        return back()->with('status','Motivo de ausencia modificado correctamente');
    }
    static function motivoResumen($motivo){
        return substr($motivo, 0, 40);
    }
    public function eliminarMotivo($motivo){
        Motivo::find($motivo)->delete();
        return back()->with('status','Motivo de ausencia eliminado correctamente');
    }
    public function nuevoMotivo(){
        Motivo::create([
            'descripcion' => request('descripcion')
        ]);
        return back()->with('status','Motivo de ausencia creado correctamente');
    }
    static function devolverDescripcion($id){
        return Motivo::find($id)->descripcion;
    }
}
