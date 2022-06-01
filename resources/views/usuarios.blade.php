@extends('layouts.usuarios')

@section('content')
    <div class="generalUsuariosLista">
        <h1>Usuarios</h1>
        <div class="buscadorUsuarios">
            <span>Buscar</span>
            <input id="filtrar" type="text" placeholder="Introduce nombre del empleado">
          </div>
        @foreach ($usuarios as $usuario)
        <div class="UsuarioLista" id="UsuarioLista">
            {{-- BOOTSTRAP --}}
            <a type="button" class="nombreListaUsuario" href="{{route('usuario',[$usuario,$hoy])}}">
                <span><p srty>{{$usuario->nombre}} {{$usuario->apellido1}} {{$usuario->apellido2}}</p></span>
            </a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editar">
                <img src="{{asset('img/editar.png')}}" alt="Editar" width="20px">
            </button>
            <!-- Modal -->
            <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar información</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <div class="modal-body">

                            {{-- INICIO FORM EDITAR --}}

                            <form method="POST" action="" id="formEditarUsuario" class="">
                                @csrf
                                @if (session('status'))
                                    <p id="status">{{session('status')}}</p>
                                @endif
                                <table>
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="nombre">{{ __('Nombre') }}</label></td>
                                        <td><input id="name" type="text" class=" @error('nombre') is-invalid @enderror" name="name" value="{{ $usuario->nombre }}" required autocomplete="name" autofocus></td>
                                    </tr>
                                    @if ($errors->has('nombre'))
                                        <tr><td colspan="2"><p style="color: red">Formato nombre no válido</p></td><tr>
                                    @endif
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="apellido1">{{ __('Primer Apellido') }}</label></td>
                                        <td><input id="apellido1" type="text" class="@error('apellido1') is-invalid @enderror" value="{{ $usuario->apellido1 }}" name="apellido1" required autocomplete="apellido1"></td>
                                    </tr>
                                    @if ($errors->has('apellido1'))
                                        <tr><td colspan="2"><p style="color: red">Formato apellido no válido</p></td><tr>
                                    @endif
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="apellido2">{{ __('Segundo Apellido') }}</label></td>
                                        <td><input id="apellido2" type="text" class="@error('apellido2') is-invalid @enderror" value="{{ old('apellido2') }}" name="apellido2" autocomplete="apellido2"></td>
                                    </tr>
                                    @if ($errors->has('apellido2'))
                                        <tr><td colspan="2"><p style="color: red">Formato apellido no válido</p></td><tr>
                                    @endif
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="contacto1">{{ __('Contacto') }}</label></td>
                                        <td><input id="contacto1" type="text" class="@error('contacto1') is-invalid @enderror" value="{{ old('contacto1') }}" name="contacto1" required autocomplete="contacto1"></td>
                                    </tr>
                                    @if ($errors->has('contacto1'))
                                        <tr><td colspan="2"><p style="color: red">Formato teléfono no válido</p></td><tr>
                                    @endif
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="contacto2">{{ __('Contacto (Secundario)') }}</label></td>
                                        <td><input id="contacto2" type="text" class="@error('contacto2') is-invalid @enderror" value="{{ old('contacto2') }}" name="contacto2" autocomplete="contacto2"></td>
                                    </tr>
                                    @if ($errors->has('contacto2'))
                                        <tr><td colspan="2"><p style="color: red">Formato teléfono no válido</p></td><tr>
                                    @endif
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="nacimiento">{{ __('Nacimiento') }}</label></td>
                                        <td><input id="nacimiento" type="date" class="@error('nacimiento') is-invalid @enderror" value="{{ old('nacimiento') }}" name="nacimiento" required autocomplete="nacimiento"></td>
                                        
                                    </tr>
                                    @if ($errors->has('nacimiento'))
                                        <tr><td colspan="2"><p style="color: red">Formato fecha no válido (dd/mm/yyyy)</p></td><tr>
                                    @endif
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="email">{{ __('Correo electrónico') }}</label></td>
                                        <td><input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{$usuario->email}}" required autocomplete="email"></td>
                                    </tr>
                                    @if ($errors->has('email'))
                                        <tr><td colspan="2"><p style="color: red">Formato email no válido o ya existe una cuenta con este email</p></td><tr>
                                    @endif
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="password">{{ __('Password') }}</label></td>
                                        <td><input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password"></td>
                                    </tr>
                                    @if ($errors->has('password'))
                                        <tr><td colspan="2"><p style="color: red">Las contraseñas no coinciden</p></td><tr>
                                    @endif
                                    <tr>
                                        <td><label style="margin-bottom: 15px;margin-top: -5px;" for="password-confirm">{{ __('Confirmar Password') }}</label></td>
                                        <td><input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"></td>
                                    </tr>
                                </table>
                            </form>
                            {{-- INICIO FORM EDITAR --}}


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-success">Guardar</button>
                    </div>
                    </div>
                </div>
            </div>
            {{-- BOOTSTRAP --}}
        </div>
        @endforeach
       
    </div>


@endsection
