<?php
    namespace App\Http\Controllers;
?>

@extends('layouts.usuario')

@section('content')
    <div class="generalUsuario">
        <h2>Gestión del usuario: <b>{{$usuario->nombre.' '.$usuario->apellido1.' '.$usuario->apellido2}}</b></h2>
        <div class="infoUsuario">
            <div class="mapa">
                <div id="map"></div>
                <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
                integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
                crossorigin=""></script>
                <script src="{{ asset('js/mapa.js') }}"></script>
            </div>
            <div class="filtroFechaInfoUsuario">
                <input type="date" id="fechaFichajesInfoUsuario" class="{{$usuario->id}}" value="{{$fecha}}">
            </div>
            <div class="fichajesInfoUsuario">
    
            </div>
        </div>
    </div>
    @foreach ($fichajes as $fichaje)
            <div style="display: none" class="fichajeMapa">
                <p class="latitudMapa" id="{{UsuariosController::fechaFormat($fichaje->created_at)}}">{{$fichaje->latitud}}</p>
                <p class="longitudMapa">{{$fichaje->longitud}}</p>
            </div>
    @endforeach
@endsection
