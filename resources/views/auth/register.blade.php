@extends('layouts.app')

@section('content')
        <form method="POST" action="{{ route('register') }}" id="formLogin" class="formRegister" style="width: 40%;">
            @csrf
            <h3 class="inicioSesionTitulo">Registrarse</h3>
            @if (session('status'))
                <p id="status">{{session('status')}}</p>
            @endif
            <table>
                <tr>
                    <td><label style="margin-bottom: 15px;margin-top: -5px;" for="nombre">{{ __('Nombre') }}</label></td>
                    <td><input id="name" type="text" class=" @error('nombre') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus></td>
                </tr>
                @if ($errors->has('nombre'))
                    <tr><td colspan="2"><p style="color: red">Formato nombre no válido</p></td><tr>
                @endif
                <tr>
                    <td><label style="margin-bottom: 15px;margin-top: -5px;" for="apellido1">{{ __('Primer Apellido') }}</label></td>
                    <td><input id="apellido1" type="text" class="@error('apellido1') is-invalid @enderror" value="{{ old('apellido1') }}" name="apellido1" required autocomplete="apellido1"></td>
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
                    <td><input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"></td>
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
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Registrarse') }}
                        </button>
                    </td>
                </tr>
                <tr><td></td>
                    <td>
                        <a href="{{ route('login') }}">
                            Ya tengo cuenta
                        </a>
                    </td>
                </tr>
            </table>
        </form>

@endsection
