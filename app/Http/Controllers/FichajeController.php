<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Fichaje;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Carbon\Carbon;
use Torann\GeoIP\Facades\GeoIP;

class FichajeController extends Controller
{
    public function fichar($fecha){
        Fichaje::create([
            'id_user' => Auth::id(),
            'latitud' => request('latitud'),
            'longitud' => request('longitud'),
            //'created_at' => Carbon::parse(request('fecha').Carbon::now()->format('H:i:s'))
        ]);
        return back()->with('status','Fichaje correcto');
    }

    public function eliminarFichaje($fichaje){
        Fichaje::find($fichaje)->delete();
        return back()->with('status','Se ha eliminado el fichaje correctamente');
    }
    public function actualizarFichajes($fecha){
        $fichajes = Fichaje::where('id_user','=',Auth::id())->where('created_at','>',Carbon::parse($fecha))->where('created_at','<',Carbon::parse($fecha)->addDay())->orderBy('id','ASC')->get()->toArray();
        $i=0;
        for ($i=0; $i < count($fichajes) ; $i++) {
            $created = $fecha.' '.request('fichaje'.$i);
                Fichaje::find($fichajes[$i]['id'])->update([
                    'created_at' => Carbon::parse($created)
                ]);

        }
        return back()->with('status','Se ha actualizado correctamente');
    }
    
}
