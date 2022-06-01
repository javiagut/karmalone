<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    
    {{-- LEAFLET --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin=""/>

    {{-- LEAFLET --}}
    <title>karmalone</title>
</head>
<body>
  
    <header>
        <img class="logoHeader" src="{{asset('img/logo.png')}}" alt="Logo Karmalone">
        <h1>karmalone</h1>
        @if ($rol == 'RRHH')

      <div class="menuRH">
        <div class="opcionMenuRH" style="{{request()->routeIs('administrarUsuarios') ? 'background-color:white;' : ''}}">
          <a href="{{route('administrarUsuarios')}}" style="{{request()->routeIs('administrarUsuarios') ? 'color:#822425;' : ''}}">Administrar Usuarios</a>
        </div>
        <div class="opcionMenuRH" style="{{request()->routeIs('/') ? 'background-color:white;' : ''}}">
          <a href="{{route('/')}}" style="{{request()->routeIs('/') ? 'color:#822425;' : ''}}">Fichar</a>
        </div>
      </div>

    @endif
    </header>

    

    @yield('content')
    <footer>
        @auth
            <a class="logoutFooter" href="{{route('logout')}}">Logout</a>
        @endauth
    </footer>
</body>
</html>