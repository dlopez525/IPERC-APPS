<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/workers.css') }}">
    <link rel="stylesheet" href="{{ asset('css/waitMe.min.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <title>@yield('title')</title>
</head>
<body>
    <div class="container-fluid contenedor">
        <div class="row wrapper justify-content-center">
            <div class="col-12 col-lg-6 left-sidebar">
                @if ($putBack)
                    <div class="row back-container">
                        <div class="col-12 back-wrapper">
                            {{-- <a href="{{ url()->previous() }}"><span class="ti-arrow-left"></span></a> --}}
                            <a href="javascript:history.back()"><span class="ti-arrow-left"></span></a>
                        </div>
                    </div>
                @endif
                <div class="row" style="margin-top: 50px">
                    <div class="col-12">
                        <div class="section-wrapper">
                            @if (session('error'))
                                <div class="alert alert-danger" id="response-panel">
                                    <div class="alert-body" id="response">{{ session('error') }}</div>
                                </div>
                            @endif
                            <div class="section-title">
                                <div class="row">
                                    <div class="col-6"><h2>@yield('title')</h2></div>
                                    <div class="col-6 d-flex align-items-end date-updated">{{ $date != '' ? 'Actualización:' : '' }} {{ $date }}</div>
                                </div>
                                <h3>@yield('subtitle')</h3>
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
                @if ($putLogo)
                    <div class="row logo-container justify-content-center">
                        <div class="col-6 logo-wrapper">
                            <img src="{{ asset('img/logo.png') }}" class="logo-img">
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-12 col-lg-6 right-sidebar d-none d-lg-block" style="background: url({{ asset("img/{$soda}.jpg") }});background-position: center;background-repeat: no-repeat;background-size: cover;"></div>
        </div>
    </div>
    
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/waitMe.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.s2').select2({
                containerCssClass: "wrap"
            });
        });
        
        $(document).ajaxStart(function(){
            run_waitMe();
            $('.buy').attr('disabled', true);
        });
        $(document).ajaxStop(function(){
            $('body').waitMe('hide');
        });
        function run_waitMe(){
            $('body').waitMe({
                effect: 'orbit',
                text: 'Cargando Datos...',
                bg: 'rgba(255,255,255,0.7)',
                color:'#000'
            });
        }
    </script>
    @yield('scripts')
</body>
</html>