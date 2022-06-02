@extends('layouts.app')
<?php
    use Carbon\Carbon;
?>
@section('content')
<div class="JefeGeneralHome">
    <div class="ausencias">
        <h2>Notificar ausencia</h2>
        <form action="{{route('notificarAusencia')}}" method="post">
            @csrf
            <table>
                <tr><td>Motivo: </td>
                    <td>
                        <select name="motivo" id="motivo">
                            @foreach ($motivos as $motivo)
                                <option value="{{$motivo->id}}">{{$motivo->descripcion}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Fecha: </td>
                    <td><input style="margin-left: 40px;" type="date" value="{{$fecha}}" name="fechaAusencia" id="fechaAusencia"></td>
                </tr>
                <tr><td></td>
                <td><input type="submit" class="btn btn-success" value="Solicitar"></td></tr>
            </table>

        </form>

        {{-- AUSENCIAS SOLICITADAS --}}
            <h2 style="margin-top: 20px">Historial de ausencias</h2>
        @if (count($ausencias)>0)
        <h3></h3>
        @endif
        @if (count($ausencias)==0)
            <p style="color: red">No hay ninguna solicitud</p>
        @endif
        @foreach ($ausencias as $ausencia)
        <div class="UsuarioLista" id="UsuarioLista" style="width: 100%;">

            <a class="nombreListaUsuario" style="justify-content: space-between;padding-right:20px;">
                <span class="horaEstadoAusencia">{{Carbon::parse($ausencia->fecha)->format('d/m/Y')}}</span><p>{{$ausencia->estado}}</p>
            </a>
            {{-- INICIO EDITAR AUSENCIA --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editar{{$ausencia->id}}">
                <img src="{{asset('img/editar.png')}}" alt="Editar" width="20px">
            </button>
            <div class="modal fade" id="editar{{$ausencia->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="{{route('actualizarAusencia', $ausencia)}}" id="formEditarUsuario" class="">
                        @csrf
                        @method('PATCH')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar solicitud</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                    <table>
                                        <tr><td>Motivo: </td>
                                            <td>
                                                <select name="motivo" id="motivo2">
                                                    @foreach ($motivos as $motivo)
                                                        <option value="{{$motivo->id}}" {{$motivo->id==$ausencia->id_motivo ? 'selected=true' : ''}}>{{$motivo->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fecha: </td>
                                            <td><input type="date" value="{{$ausencia->fecha}}" name="fechaAusencia" id="fechaAusencia"></td>
                                        </tr>
                                        @if ($fecha>$ausencia->fecha)
                                            <tr>
                                                <td colspan="2"><p style="color: red">Esta solicitud no se puede modificar ya que ha caducado</p></td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                            @if ($fecha<=$ausencia->fecha)
                                <button type="submit" class="btn btn-success">Guardar</button>
                            @endif
                            
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- FIN EDITAR AUSENCIA --}}
            @if ($fecha<=$ausencia->fecha)
                {{-- INICIO ELIMINAR USUARIO --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eliminar{{$ausencia->id}}">
                    <img src="{{asset('img/basura.png')}}" alt="Editar" width="20px">
                </button>
                <!-- Modal -->
                <div class="modal fade" id="eliminar{{$ausencia->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="POST" action="{{route('eliminarAusencia', $ausencia)}}" id="formEditarUsuario" class="">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar solicitud</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                        <p>Estás seguro que quieres eliminar la solicitud?</p>
                                    </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                                <button type="submit" class="btn btn-success">Si, estoy seguro</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            {{-- FIN ELIMINAR USUARIO --}}
            @endif
        </div>
        @endforeach
        {{ $ausencias->links() }}
        {{-- AUSENCIAS SOLICITADAS --}}

    </div>
    <div class="generalHome">
    
        <div class="divFichar">
            @if (session('status'))
                <div class="alert alert-success" role="alert" id="status">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert" id="status" style="color: white;background-color:red;">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{route('fichar', $fecha)}}" method="POST" id="formFichar">
                @csrf
                <input type="text" name="latitud" value="" id="latitud" >
                <input type="text" name="longitud" value="" id="longitud">
                <input type="submit" value="{{$accion}}" id="fichar" class="gradient-border" disabled>
            </form>
            <p id="sinPermisoUbi">Es necesario activar la ubicación en su navegador y recargar la página</p>
        </div>
        <div class="divFichajes">
            @if (count($fichajes)>0)
            <?php 
                $widths = [];
            ?>
                @for ($i = 0; $i < count($fichajes); $i++)
                    <?php
                        $e=$i+1;
                    ?>
                    <?php
                        $entrada = date('H', strtotime($fichajes[$i]['created_at']));
                    ?>
                    @if ($i==0)
                    <!--        Tiempo anterior al inicio de jornada         -->
                        <p class="noTrabajo" style='width:{{$entrada*20}}px'></p>
                    @endif

                    @if(isset($fichajes[$e]))
                    <!--        Tiempo fichaje si se ha salido        -->
                        <?php
                            $salida = date('H', strtotime($fichajes[$e]['created_at']));
                            $width = intval($salida) - intval($entrada);
                        ?>
                    @else
                    <!--        Tiempo fichaje si aún NO se ha salido        -->
                        <?php
                            $salida = date('H');
                            $width = intval($salida) - intval($entrada);
                        ?>
                    @endif
                    @if ($width>0)
                        <?php 
                            $widths[count($widths)] = $width*20;
                            $suma = array_sum($widths);
                        ?>
                        <p class="fichaje" style="width:{{$width*20}}px"></p>
                        <span id="hora" style="margin-left: {{($entrada*20)-15}}px">{{date('H:i', strtotime($fichajes[$i]['created_at']))}}</span>
                    @endif
                @endfor
                <span id="hora" style="margin-left: {{($entrada*20)-15}}px">{{date('H:i', strtotime($fichajes[$i-1]['created_at']))}}</span>
                <p class="noTrabajoFinal" style='width:{{480-$entrada*20}}px'></p>
            @else
                <p style="color: red">No hay fichajes en la fecha indicada</p>
            @endif
        </div>
        @if (count($fichajes)>0)
            <p>Hoy llevas trabajado: {{$tiempoTrabajado}} horas</p>
        @endif
        <input type="date" id="fechaFichajes" value="{{$fecha}}">
        @if (count($fichajes)>0)
    <div class="generalTablaFichajes">
        <div id="tablaFichajes">
            <form method='POST' action="{{route('actualizarFichajes',$fecha)}}">
                @csrf
                @method('PATCH')
            <table class="tabelFich">
                <tr class="informativoFichajes">
                    <td>
                        <button class="guardarFichajes" type="submit"><img class="guardar_fich" src="{{asset('img/guardar.jpg')}}"></button>
                    </td>
                    <th>Acción</th>
                    <th>Hora</th>
                </tr>
                <?php $i=0 ?>
                @foreach ($fichajes as $fichaje)
                    <tr>
                        <td></td>
                        <td class="accion" {{$i==0 || $i%2==0 ? 'style=color:green' : 'style=color:red'}}>{{$i==0 || $i%2==0 ? 'Entrada' : 'Salida'}}</td>
                        <?php  $hora = date('H:i', strtotime($fichaje['created_at'])) ?>
                        <td><input name="fichaje{{$i}}" class="horaFichaje" type="time" value="{{$hora}}" required></td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            </table>
            </form>
            <table>
                    <tr><td></td></tr>
                </form>
                    @foreach ($fichajes as $fichaje)
                        <tr>
                            <td>
                                <form style="height: 30px" action="{{ route('eliminarFichaje', $fichaje['id']) }}" method="POST" >
                                    @csrf @method('DELETE')
                                    <button class="eliminarFichaje" type="submit"><img class="basura_fich" src="{{asset('img/basura.png')}}"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endif
    </div>
    @if (count($fichajes)>0)
        <div class="jefeLeyenda">
            <div id="leyenda">
                <table>
                    <tr>
                        <td class="colorTrab"></td>
                        <td>Trabajado</td>
                    </tr>
                    <tr>
                        <td class="colorDes"></td>
                        <td>Descanso</td>
                    </tr>
                    <tr>
                        <td class="colorNoTrab"></td>
                        <td>No trabajado</td>
                    </tr>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
