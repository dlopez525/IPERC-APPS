<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body class="welcome">
        <div class="flex-center position-ref full-height">
            
            <div class="content">
                <div class="logo">
                    <img src="{{ asset('img/logo.png') }}" height="200px" width="auto" alt="Identificación de peligros, evaluación de riesgos y sus controles">
                </div>
                <div class="welcometitle">
                    <h2>Identificación de peligros, evaluación de riesgos y sus controles</h2>
                </div>
                <div class="links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}">Inicio</a>
                        @else
                            <a href="{{ route('login') }}">Panel Admin</a>
                        @endauth
                        <a href="{{ route('wlogin') }}">Trabajadores</a>
                    @endif
                </div>
                <footer>
                    Plataforma para uso exclusivo de colaboradores de las empresas de Arca Continental Perú
                </footer>    
            </div>
        </div>
    </body>
</html>
