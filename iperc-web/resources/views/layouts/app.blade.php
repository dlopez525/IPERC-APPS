<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <link href="{{ asset('css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/loader.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/structure.css') }}" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/waitMe.min.css') }}">
    <style>
        .layout-px-spacing {
            min-height: calc(100vh - 166px)!important;
        }
    </style>
    @yield('styles')
</head>
<body>
    @include('partials.loader')
    @include('partials.navbar')
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('partials.sidebar')
        
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    @yield('content')
                </div>

            </div>
            @include('partials.footer')
        </div>

    </div>

    {{-- CHANGE HEADQUARTER MODAL --}}

    <div class="modal fade" id="changeHeadquarter" tabindex="-1" role="dialog" aria-labelledby="changeHeadquarterLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar de Sede</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('configuration.chageheadquarter') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>Sede</label>
                            <select name="headquarter" id="headquarter" class="form-control" required>
                                <option value="">Seleccione una Sede</option>
                                @foreach ($headquarters as $h)
                                    <option value="{{ $h->id }}" {{ session()->get('headlocal') == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Cambiar de Sede</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/waitMe.min.js') }}"></script>
    <script>
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
                color:'#CA293E'
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
