<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Fichaje;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class FichajeController extends Controller
{
    public function fichar(){

        Fichaje::create([
            'id_user' => Auth::id(),
            'latitud' => request("latitud"),
            'longitud' => request("longitud")
        ]);
        echo 'OK';
    }

    public function eliminarFichaje($fichaje){
        Fichaje::find($fichaje)->delete();
        return back()->with('status','Se ha eliminado el fichaje correctamente');
    }
    public function actualizarFichajes($fichaje){
        $ahora = time();
        $unDiaEnSegundos = 24 * 60 * 60;
        $manana = $ahora + $unDiaEnSegundos;
        $mananaLegible = date("Y-m-d", $manana);
        $ahoraLegible = date("Y-m-d", $ahora);
        $fichajes = Fichaje::where('id_user','=',Auth::id())->where('created_at','>',$ahoraLegible)->where('created_at','<',$mananaLegible)->orderBy('id','ASC')->get()->toArray();
        $i=0;
        for ($i=0; $i < count($fichajes) ; $i++) {

            $fecha = strval(date("Y-m-d", strtotime($fichajes[$i]['created_at'])));
            $created = $fecha.' '.request('fichaje'.$i);
                Fichaje::find($fichajes[$i]['id'])->update([
                    'created_at' => strtotime($created)
                ]);

        }
        return back()->with('status','Se ha actualizado correctamente');
    }

    
}
