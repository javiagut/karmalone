<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fichaje extends Model
{
    protected $fillable = ['id_user','latitud','longitud','created_at'];
    use HasFactory;

    static function fichajesHoy($fecha){
        return Fichaje::where('id_user','=',Auth::id())->where('created_at','>',Carbon::parse($fecha))->where('created_at','<',Carbon::parse($fecha)->addDay())->orderBy('id','ASC')->get()->toArray();
    }

    static function tiempoTrabajado($fecha){
        $fichajes = Fichaje::where('id_user','=',Auth::id())->where('created_at','>',Carbon::parse($fecha))->where('created_at','<',Carbon::parse($fecha)->addDay())->orderBy('id','ASC')->get();
        $horas = [];
        $i=0;
        foreach ($fichajes as $fichaje){
            $i++;
            if ($i<count($fichajes)){
                $entrada=$fichaje->created_at;
                $salida=$fichajes[$i]->created_at;
                $horas[count($horas)]=$entrada->diffInMinutes($salida);
            }
        }
        if (count($fichajes)%2!=0) {
            $entrada=$fichajes[count($fichajes)-1]->created_at;
            $salida=Carbon::now();
            $horas[count($horas)]=$entrada->diffInMinutes($salida);
        }
        $total=0;
        for ($i=0; $i < count($horas) ; $i++) { 
            if ($i==0 || $i%2==0) {
                $total+=$horas[$i];
            }
        }
        return number_format($total/60,2);
    }
}
