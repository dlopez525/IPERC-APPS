@extends('layouts.workers', ['soda' => '7', 'putLogo' => false, 'putBack' => true, 'date' => ''])
@section('title', 'Controles')
@section('content')
    <div class="section-form">
        <div class="row">
            <div class="col-12">
                <h5 class="page-title">Controles de Ingeniería</h5>
                <div class="card-custom">
                    <p>{!! Str::of($iperc->engineering_controls)->replace('*', '<br> -') !!}</p>
                </div>
                <h5 class="page-title">Controles Administrativos</h5>
                <div class="card-custom">
                    <p>{!! Str::of($iperc->administrative_controls)->replace('*', '<br> -') !!}</p>
                </div>
                <h5 class="page-title">EPP</h5>
                <div class="card-custom">
                    <p>{!! Str::of($iperc->epps)->replace('*', '<br> -') !!}</p>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-12 mb-4">
                <a class="custom-btn-primary" href="{{ route('wlogin') }}">NUEVA CONSULTA</a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection