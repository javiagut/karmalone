<?php

namespace App\Http\Controllers;

use App\Models\Ausencia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AusenciaController extends Controller
{
    public function notificarAusencia(){
        if(request('fechaAusencia')<Carbon::today()->format('Y-m-d')){
            $result = 'error';
            $mensaje = 'La fecha de solicitud no puede ser inferior a la de hoy';
        }
        else{
            Ausencia::create([
                'id_user' => Auth::id(),
                'id_motivo' => request('motivo'),
                'estado' => 'Pendiente',
                'fecha' => request('fechaAusencia')
            ]);
            $result = 'status';
            $mensaje = 'Solicitud enviada';
        }
        return back()->with($result,$mensaje);
    }
    public function actualizarAusencia($ausencia){
        if(request('fechaAusencia')<Carbon::today()->format('Y-m-d')){
            $result = 'error';
            $mensaje = 'La fecha de solicitud no puede ser inferior a la de hoy';
        }
        else{
            Ausencia::find($ausencia)->update([
                'id_motivo' => request('motivo'),
                'estado' => 'Pendiente',
                'fecha' => request('fechaAusencia')
            ]);
            $result = 'status';
            $mensaje = 'Solicitud enviada';
        }
        return back()->with($result,$mensaje);
    }
    public function eliminarAusencia($id){

        Ausencia::find($id)->delete();

        return back()->with('status','Se ha eliminado la solicitud correctamente');
    }
    public function actualizarEstado($id){
        Ausencia::find($id)->update([
            'estado' => request('estado')
        ]);
        return back()->with('status','Se ha modificado el estado de la ausencia correctamente');
    }
}
