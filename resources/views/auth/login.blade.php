@extends('layouts.appLogin')
@section('content')
    <form method="POST" action="{{ route('login') }}" id="formLogin">
        <h3 class="inicioSesionTitulo">Iniciar Sesión</h3>
        @if (session('status'))
            <p id="status">{{session('status')}}</p>
        @endif
        @csrf

        <table class="tableLogin">
            <div>
                @if ($errors->has('email'))
                    <tr><td colspan="2"><p style="color: red">Datos de acceso incorrectos</p></td><tr>
                @endif
                <tr>
                    <td>
                        <img class="iconosLogin" src="img/email.jpg"><input id="email" type="email"rol @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email" >
                    </td>
                </tr>
            </div>

            <div>
                <tr>
                    <td>
                        <img class="iconosLogin" src="img/password.png" style="height:30px;width:30px;margin-top:-4px;"><input id="password" type="password"rol @error('password') is-invalid @enderror name="password" required autocomplete="current-password">
                    </td>
                </tr>
            </div>

            <div>
                <tr>
                    <td class="checkboxLogin"><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            Recordarme
                        </label>
                    </td>
                </tr>
            </div>

            <div>
                <tr>
                    <td>
                        <button type="submit">
                            {{ __('Login') }}
                        </button>
                        
                    </td>
                </tr>
                @if (Route::has('password.request'))
                    <tr>
                        <td>
                            <a href="{{ route('password.request') }}">
                                He olvidado mi contraseña
                            </a>
                        </td>
                    </tr>    
                @endif
            </div>
            <tr>
                <td>
                    <a href="{{ route('register') }}">
                        Registrarse
                    </a>
                </td>
            </tr> 

        </table>

        
    </form>
@endsection
