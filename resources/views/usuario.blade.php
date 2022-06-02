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
                @if (count($fichajes)>0)
                    <table class="tablaInfoFichajesUsuario">
                        <tr class="informativoFichajes" style="border-radius: 10px;">
                            <th>Acción</th>
                            <th>Hora</th>
                            <th style="width: 35%;"><small>Última actualización</small></th>
                        </tr>
                        <?php $i=0 ?>
                        @foreach ($fichajes as $fichaje)
                            <tr>
                                <td class="accion" {{$i==0 || $i%2==0 ? 'style=color:green' : 'style=color:red'}}>{{$i==0 || $i%2==0 ? 'Entrada' : 'Salida'}}</td>
                                <?php  $hora = date('H:i', strtotime($fichaje['created_at'])) ?>
                                <td>{{$hora}}</td>
                                <td>
                                    <?php  $act = date('d/m/Y H:i ', strtotime($fichaje['updated_at'])) ?>
                                    {{$act}}
                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                    </table>
                @else
                    <h3 style="color:red">No hay fichajes en la fecha indicada</h3>
                @endif
                @if (count($ausencias)>0)
                @if (session('status'))
                    <div style="margin-top:40px;" class="alert alert-success" role="alert" id="status">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div style="margin-top:40px;background-color:red;color:white;" class="alert alert-success" role="alert" id="status">
                        {{ session('error') }}
                    </div>
                @endif
                <table id="tablaAusencias">
                    @foreach ($ausencias as $ausencia)
                    <tr style="background-color: #0074EC;color:white;"><td colspan="4"><h3 style="margin: 0;">Ausencia</h3></td></tr>
                        <tr>
                            <form action="{{route('actualizarEstado', $ausencia)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <td style="background-color: rgb(255, 230, 230)">Motivo</td>
                                <td>{{MotivoController::devolverDescripcion($ausencia->id_motivo)}}</td>
                                <td>
                                    <select name="estado" id="estado">
                                        <option value="Pendiente" {{'Pendiente'==$ausencia->estado ? 'selected=true' : ''}}>Pendiente</option>
                                        <option value="Aceptada" {{'Aceptada'==$ausencia->estado ? 'selected=true' : ''}}>Aceptada</option>
                                        <option value="Rechazada" {{'Rechazada'==$ausencia->estado ? 'selected=true' : ''}}>Rechazada</option>
                                    </select>
                                </td>
                                <td><input class="btn btn-success" type="submit" value="Guardar"></td>
                            </form>
                        </tr>
                    @endforeach
                </table>
                @endif
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
