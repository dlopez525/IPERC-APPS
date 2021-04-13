@extends('layouts.auth')

@section('content')
<div class="form-content">
    <h1 class="">Inicie sesión</h1>
    <p class="signup-link"></p>
    <form class="text-left" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form">
            <div id="username-field" class="field-wrapper input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div id="password-field" class="field-wrapper input mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper toggle-pass">
                    <p class="d-inline-block">Mostrar Contraseña</p>
                    <label class="switch s-danger">
                        <input type="checkbox" id="toggle-password" class="d-none">
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="field-wrapper">
                    <button type="submit" class="btn btn-danger" value="">Ingresar</button>
                </div>
            </div>
            {{-- <div class="field-wrapper text-center keep-logged-in">
                <div class="n-chk new-checkbox checkbox-outline-danger">
                    <label class="new-control new-checkbox checkbox-outline-danger">
                      <input class="new-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <span class="new-control-indicator"></span>Mantenme conectado
                    </label>
                </div>
            </div> --}}
            @if (Route::has('password.request'))
                <div class="field-wrapper">
                    <a href="{{ route('password.request') }}" class="forgot-pass-link">¿Olvidaste tu Contaseña?</a>
                </div>
            @endif
        </div>
    </form>                        
    {{-- <p class="terms-conditions">© {{ date('Y') }} Todos los Derechos Reservados.</p> --}}
</div>            
@endsection