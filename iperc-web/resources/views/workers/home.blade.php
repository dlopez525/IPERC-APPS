@extends('layouts.workers', ['soda' => '2', 'putLogo' => true, 'putBack' => true, 'date' => ''])
@section('title', 'Bienvenido')
@section('subtitle', 'Colaborador')
@section('content')
    <div class="section-form">
        <form action="{{ route('workerhome.process') }}" id="form" method="POST">
            @csrf
            <div class="custom-form-group">
                <label class="custom-form-label">Selecciona tu Puesto de Trabajo</label>
                <input type="hidden" name="worker" value="{{ $worker->id }}">
                <input type="hidden" name="headquarter" id="headquarter" value="{{ $headquarter }}">
                <select class="custom-form-control s2" id="job-position" name="job_position" required>
                    <option value="">Seleccione un Puesto de Trabajo</option>
                    @foreach ($jobPositions as $jobPositions)
                        <option value="{{ $jobPositions->name }}">{{ $jobPositions->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="custom-form-group">
                <label class="custom-form-label">Selecciona tu Área</label>
                <select class="custom-form-control s2" id="area" name="area" required>
                    <option value="">Seleccione una Área de Trabajo</option>
                </select>
            </div>
            <div class="custom-form-group">
                <label class="custom-form-label">Seleccione tu Zona</label>
                <select name="zone" id="zone" class="custom-form-control s2" required></select>
            </div>
            <div class="form-group">
                <button class="custom-btn-primary" type="submit" id="send">Continuar</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $('#send').attr('disabled', true);
        $('#sub-process').attr('disabled', true);
        $('#zone').attr('disabled', true);
        $('#area').attr('disabled', true);
        
        $('#job-position').change(function () {
            $.ajax({
                type: 'post',
                url: '/api/get-areas',
                data: {
                    job_position: $('#job-position').val(),
                    headquarter: $('#headquarter').val(),
                    key: 'a4bbc5f9e21b96da90df40bd89f8d9fa097f384d',
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    let option = '<option value="">Seleccione una Área de Trabajo</option>';
                    for (var i = 0; i < response.length; i++) {
                        option += '<option value="' + response[i].name + '">' + response[i].name + '</option>';
                    }

                    $('#area').html('');
                    $('#area').append(option);
                    $('#area').attr('disabled', false);
                },
                error: function(response) {
                    console.log(response.responseText)
                }
            });
        });
        $('#area').change(function () {
            $.ajax({
                type: 'post',
                url: '/api/get-zones',
                data: {
                    job_position: $('#job-position').val(),
                    area: $('#area').val(),
                    key: 'a4bbc5f9e21b96da90df40bd89f8d9fa097f384d',
                    headquarter: $('#headquarter').val()
                },
                dataType: 'json',
                success: function(response) {
                    let option = '<option value="">Seleccione su Zona</option>';
                    for (var i = 0; i < response.length; i++) {
                        option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                    }

                    $('#zone').html('');
                    $('#zone').append(option);
                    $('#zone').attr('disabled', false);
                },
                error: function(response) {
                    console.log(response.responseText)
                }
            });
        });
        $('#zone').change(function () {
            if ($(this).val() != '') {
                $('#send').attr('disabled', false);
            } else {
                $('#send').attr('disabled', true);
            }
        });
    </script>
@endsection