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
        if(Carbon::parse($fecha)->greaterThan(Carbon::now())==true){
            $res = 'error';
            $miss = 'Fecha no puede ser mayor a la actual';
        }
        else{
            Fichaje::create([
                'id_user' => Auth::id(),
                'latitud' => request('latitud'),
                'longitud' => request('longitud'),
                'created_at' => Carbon::parse(request('fecha').Carbon::now()->format('H:i:s'))
            ]);
            $res = 'status';
            $miss = 'Se ha actualizado correctamente';
        }
        return back()->with($res,$miss);
    }

    public function eliminarFichaje($fichaje){
        Fichaje::find($fichaje)->delete();
        return back()->with('status','Se ha eliminado el fichaje correctamente');
    }
    public function actualizarFichajes($fecha){
        
        $fichajes = Fichaje::where('id_user','=',Auth::id())->where('created_at','>',Carbon::parse($fecha))->where('created_at','<',Carbon::parse($fecha)->addDay())->orderBy('id','ASC')->get()->toArray();
        $i=0;
        $res = '';
        for ($i=0; $i < count($fichajes) ; $i++){
            $created = Carbon::parse($fecha.' '.request('fichaje'.$i));
            if($created->greaterThan(Carbon::now())==true){
                $res = 'error';
                $miss = 'Fecha no puede ser mayor a la actual';
            }
            else{
                Fichaje::find($fichajes[$i]['id'])->update([
                    'created_at' => $created
                ]);
                if ($res=='') {
                    $res = 'status';
                    $miss = 'Se ha actualizado correctamente';
                }
            }
            
        }

        return back()->with($res,$miss);
    }
    
}
