@extends('layouts.administracion')
<?php namespace App\Http\Controllers ?>
@section('content')
    <div class="generalUsuariosLista" style="margin-bottom: 50px">
        <h1>Motivos de ausencia</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert" id="status" style="width: 40%">
                {{ session('status') }}
            </div>
        @endif
        <div class="buscadorUsuarios">
            <span style="margin-right: 15px">Buscar</span>
            <input id="filtrar" type="text" placeholder="Introduce nombre del motivo de ausencia">
        </div>
        @foreach ($motivos as $motivo)
        {{-- INICIO ROW USUARIO --}}
        <div class="UsuarioLista" id="UsuarioLista">

            {{-- INICIO EDITAR USUARIO --}}

            <a class="nombreListaUsuario">
                <span><p>{{MotivoController::motivoResumen($motivo->descripcion)}}</p></span>
            </a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editar{{$motivo->id}}">
                <img src="{{asset('img/editar.png')}}" alt="Editar" width="20px">
            </button>
            <div class="modal fade" id="editar{{$motivo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="{{route('actualizarMotivo', $motivo)}}" id="formEditarUsuario" class="">
                        @csrf
                        @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar motivo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="descripcion">{{ __('Motivo') }}</label></td>
                                        <td><textarea class="textarea" rows="10" maxlength="255" id="name" type="text" class=" @error('descripcion') is-invalid @enderror" name="descripcion" required>{{ $motivo->descripcion }}</textarea></td>
                                    </tr>
                                </table>
                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
            {{-- FIN EDITAR USUARIO --}}

            {{-- INICIO ELIMINAR USUARIO --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eliminar{{$motivo->id}}">
                <img src="{{asset('img/basura.png')}}" alt="Editar" width="20px">
            </button>
            <!-- Modal -->
            <div class="modal fade" id="eliminar{{$motivo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="{{route('eliminarMotivo', $motivo)}}" id="formEditarUsuario" class="">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar motivo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                    <p>Estás seguro que quieres eliminar el motivo de ausencia?</p>
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
        </div>
        @endforeach
        {{-- INICIO CREAR USUARIO --}}

        <div class="UsuarioLista" id="UsuarioLista">

            <a class="nombreListaUsuario" href="{{route('usuario',[$motivo,$hoy])}}" data-toggle="modal" data-target="#crearMotivo">
                <span><p>Nuevo motivo</p></span>
            </a>
            <div class="modal fade" id="crearMotivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="{{route('nuevoMotivo')}}" id="formEditarUsuario" class="">
                        @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo motivo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <td>Motivo</td>
                                        <td><textarea class="textarea" rows="10" maxlength="255" id="name" type="text" class=" @error('descripcion') is-invalid @enderror" name="descripcion" required></textarea></td>
                                    </tr>
                                </table>
                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-success">Crear</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>

        {{-- FIN CREAR USUARIO --}}
    </div>

@endsection
