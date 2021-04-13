@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection
@section('content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header py-3 px-3">
            <div class="row">
                <div class="col-12">
                    <h3>Editando IPERC</h3>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            {{ Form::model($iperc, ['route' => ['iperc.update', $iperc->id]]) }}
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <p><strong>Área:</strong> {{ $iperc->task->activity->subProcess->zone->area->name }}</p>
                        <p><strong>Zona:</strong> {{ $iperc->task->activity->subProcess->zone->name }}</p>
                        <p><strong>Sub-Proceso:</strong> {{ $iperc->task->activity->subProcess->name }}</p>
                        <p><strong>Ultima Actualización:</strong> {{ date('d-m-Y', strtotime($iperc->last_update)) }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>Puesto de Trabajo:</strong> {{ $iperc->task->activity->subProcess->zone->area->JobPosition->name }}</p>
                        <p><strong>Actividad:</strong> {{ $iperc->task->activity->name }}</p>
                        <p><strong>Tarea:</strong> {{ $iperc->task->name }}</p>
                        <p><strong>Actualizado por:</strong> {{ $iperc->user->name }}</p>
                    </div>
                </div>
                <hr>
                @include('iperc.partials.form')
                <div class="row mt-4">
                    <div class="col-12 mt-4">
                        <a href="{{ route('iperc.index') }}" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-danger">Guardar</button>
                        {{-- <button type="reset" class="btn btn-danger">Borrar</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/custom-select2.js') }}"></script>
    <script>
        var ss = $(".basic").select2();

        function calculateDanger() {
            let consecuence = $('#consecuence'),
                exposition = $('#exposition'),
                probability = $('#probability'),
                grade = $('#grade');

            let gradeResult = parseFloat(consecuence.val()).toFixed(1) * parseFloat(exposition.val()).toFixed(1) * parseFloat(probability.val()).toFixed(1);
            grade.val(parseFloat(gradeResult).toFixed(1));
        }

        $('#consecuence').change(function () {
            calculateDanger();
        });
        $('#exposition').change(function () {
            calculateDanger();
        });
        $('#probability').change(function () {
            calculateDanger();
        });
    </script>
@endsection