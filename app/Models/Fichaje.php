<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fichaje extends Model
{
    protected $fillable = ['id_user','latitud','longitud','created_at'];
    use HasFactory;

    static function preguntarFichar(){
        return Fichaje::where('id_user','=',Auth::id())->get();
    }

    static function fichajesHoy(){
        $ahora = time();
        $unDiaEnSegundos = 24 * 60 * 60;
        $manana = $ahora + $unDiaEnSegundos;
        $mananaLegible = date("Y-m-d", $manana);
        $ahoraLegible = date("Y-m-d", $ahora);
        return Fichaje::where('id_user','=',Auth::id())->where('created_at','>',$ahoraLegible)->where('created_at','<',$mananaLegible)->orderBy('id','ASC')->get()->toArray();
    }
}
