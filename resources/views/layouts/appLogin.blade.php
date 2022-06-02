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
    <title>karmalone</title>
</head>
<body class="bodyLogin">
    <header>
        <img class="logoHeader" src="{{asset('img/logoNegro.png')}}" alt="Logo Karmalone">
        <a href="{{route('/')}}"><h1>karmalone</h1></a>
        @yield('content')
    </header>
    {{-- <footer>
        @auth
            <a class="logoutFooter" href="{{route('logout')}}">Logout</a>
        @endauth
    </footer> --}}
    
    <div class="apartado1Home">
        <div class="apartado1Hometexto">
            <div>Control horario</div>
            <p>Lleva tu empresa a otro nivel con la mejor herramienta de gestión y control horario</p>
        </div>
        <div><img src="{{asset('img/home_1.png')}}" alt=""></div>
    </div>
    
    <div class="apartado2Home">
        <div class="texto2"><img src="{{asset('img/rrhh.png')}}" alt=""></div>
        <div class="apartado2Hometexto">
            <div>Recursos Humanos</div>
            <p>Utiliza el control horario para optimizar los procesos y aumentar la productividad</p>
        </div>
    </div>

    <footer>

        <div class="container__footer">
            <div class="box__footer">
                <div class="logo">
                    <img style="width: 60px" src="{{asset('img/logoNegro.png')}}" alt=""><span class="nombreKfooter">karmalone</span>
                </div>
                <div class="terms">
                    <p>Somos líderes en la digitalización de la gestión del tiempo solucionando las casuísticas complejas de HR. Satisfacer las necesidades y mejorar tus procesos solo se logra con una herramienta especializada en la gestión del tiempo.</p>
                </div>
            </div>
            <div class="box__footer">
                <h2>Funcionalidades</h2>
                <a href="">Control Horario</a>
                <a href="">Ubicación</a>
                <a href="">Recursos Humanos</a>
                <a href="">Personalización</a>
            </div>
  
            <div class="box__footer">
                <h2>Sobre nosotros</h2>
                <a href="">Plantilla</a>
                <a href="">Recorrido</a>
                <a href="">Referencias</a>
                <a href="">Contacto</a>              
            </div>

            <div class="box__footer">
                <h2>Redes Sociales</h2>
                <a href=""><i><img class="icoRS" src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt=""></i>Facebook</a>
                <a href=""><i><img class="icoRS" src="https://cdn.icon-icons.com/icons2/1584/PNG/512/3721677-twitter_108058.png" alt=""></i>Twitter</a>
                <a href=""><i><img class="icoRS" src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt=""></i>Linkedin</a>
                <a href=""><i><img class="icoRS" src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt=""></i>Instagram</a>
            </div>

        </div>

        <div class="box__copyright">
            <hr>
            <p>Todos los derechos reservados © 2022 <b>karmalone</b></p>
        </div>
    </footer>

</body>
</html>