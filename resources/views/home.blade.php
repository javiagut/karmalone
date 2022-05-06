@extends('layouts.app')

@section('content')
<div class="generalHome">
    <div class="divFichar">
        @if (session('status'))
            <div class="alert alert-success" role="alert" id="status">
                {{ session('status') }}
            </div>
        @endif
    
        <button id="fichar">{{$accion}}</button>
        <p id="sinPermisoUbi">Es imprescindible habilitar la ubicación para fichar</p>
        <p id="estado"></p>
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
                    <span id="hora" style="width: {{$entrada*20}}px">{{date('H:i', strtotime($fichajes[$i]['created_at']))}}</span>
                @endif
            @endfor
            <span id="hora" style="width: {{$entrada*20}}px">{{date('H:i', strtotime($fichajes[$i-1]['created_at']))}}</span>
            <p class="noTrabajoFinal" style='width:{{480-$entrada*20}}px'></p>
        @else
            <p style="color: red">Hoy no ha fichado</p>
        @endif
    </div>
</div>
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
@if (count($fichajes)>0)
    <div id="tablaFichajes">
        <form method='POST' action="{{route('actualizarFichajes',$fichajes[0]['id'])}}">
            @csrf
            @method('PATCH')
        <table>
            <tr class="informativoFichajes">
                <td>
                    <button class="guardarFichajes" type="submit"><img class="guardar_fich" src="img/guardar.jpg"></button>
                </td>
                <td>Acción</td>
                <td>Hora</td>
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
                            <form action="{{ route('eliminarFichaje', $fichaje['id']) }}" method="POST" >
                                @csrf @method('DELETE')
                                <button class="eliminarFichaje" type="submit"><img class="basura_fich" src="img/basura.png"></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </table>
    </div>
@endif
@endsection
