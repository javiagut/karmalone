<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/rh.js') }}"></script>
    <title>karmalone</title>
</head>
<body>
    <header>
        <img class="logoHeader" src="{{asset('img/logo.png')}}" alt="Logo Karmalone">
        <h1>karmalone</h1>
    </header>
    @yield('content')
    <footer>
        @auth
            <a class="logoutFooter" href="{{route('logout')}}">Logout</a>
        @endauth
    </footer>
</body>
</html>