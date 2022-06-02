@extends('layouts.appLogin')
@section('content')

    <div class="menuRH">
        <div class="dropdown">
            <button class="desplegableAdministr dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Iniciar Sesión
            </button>
            <div style="height: 1000%;" class="dropdown-menu inS" aria-labelledby="dropdownMenuButton">
            
                <form method="POST" action="{{ route('login') }}" id="formLogin" name="formLogin" style="width:100%;margin-left: 100px;border: none;box-shadow:none;padding:20px;margin:0px;">
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
                                    <img class="iconosLogin" src="img/email.jpg"><input style="margin-left: 40px;" id="email" type="email"rol @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email" >
                                </td>
                            </tr>
                        </div>
            
                        <div>
                            <tr>
                                <td>
                                    <img class="iconosLogin" src="img/password.png" style="height:30px;width:30px;margin-top:-4px;"><input style="margin-left: 40px;" id="password" type="password"rol @error('password') is-invalid @enderror name="password" required autocomplete="current-password">
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
                                        <a href="#">
                                            He olvidado mi contraseña
                                        </a>
                                    </td>
                                </tr>    
                            @endif
                        </div>
            
                    </table>
            
                    
                </form>

            </div>
        </div>
    </div>

    
@endsection
