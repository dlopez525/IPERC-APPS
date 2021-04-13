@extends('layouts.workers', ['soda' => '1', 'putLogo' => true, 'putBack' => false, 'date' => ''])
@section('title', 'Inicio')
@section('content')
    <div class="section-form">
        <form action="{{ route('authenticate') }}" method="POST">
            @csrf
            <div class="custom-form-group">
                <label class="custom-form-label">Sede</label>
                <select name="headquarter" id="headquarters" class="custom-form-control s2" required>
                    <option value="">Seleccione su Sede</option>
                    @foreach ($headquarters as $headquarter)
                        <option value="{{ $headquarter->id }}">{{ $headquarter->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="custom-form-group">
                <label class="custom-form-label">Ingrese tu Código SAP</label>
                <input type="number" name="sap" class="custom-form-control" autocomplete="off" required>
            </div>
            <div class="form-group">
                <button class="custom-btn-primary" type="submit" >ENTRAR</button>
            </div>
        </form>
    </div>
@endsection