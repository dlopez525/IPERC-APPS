@extends('layouts.workers', ['soda' => '3', 'putLogo' => true, 'putBack' => true, 'date' => ''])
@section('title', 'Criterios')
@section('content')
    <div class="section-form">
        <form action="{{ route('criteria.process') }}" method="POST">
            @csrf
            <div class="custom-form-group">
                <label class="custom-form-label">Seleccione tu Sub-Proceso</label>
                <select name="sub_process" id="sub-process" class="custom-form-control s2" required>
                    <option value="">Seleccione tu Sub-Proceso</option>
                    @foreach ($subProcesses as $subProcess)
                        <option value="{{ $subProcess->id }}">{{ $subProcess->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="custom-form-group">
                <label class="custom-form-label">Selecciona tu Puesto de Trabajo</label>
                <select name="job_position" id="job-position" class="custom-form-control s2">
                    <option value="">Seleccione tu Puesto</option>
                    @foreach ($jobPositions as $jobPosition)
                        <option value="{{ $jobPosition->id }}">{{ $jobPosition->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="custom-form-group">
                <label class="custom-form-label">Seleccione la Actividad en Consulta</label>
                <select name="activity" id="activity" class="custom-form-control s2"></select>
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
        $('#activity').attr('disabled', true);
        $('#sub-process').change(function () {
            $.ajax({
                type: 'post',
                url: '/api/get-activities',
                data: {
                    sub_process: $('#sub-process').val(),
                    key: 'a4bbc5f9e21b96da90df40bd89f8d9fa097f384d',
                },
                dataType: 'json',
                success: function(response) {
                    let option = '<option value="">Seleccione la Actividad en Consulta</option>';
                    for (var i = 0; i < response.length; i++) {
                        option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                    }

                    $('#activity').html('');
                    $('#activity').append(option);
                    $('#activity').attr('disabled', false);
                },
                error: function(response) {
                    console.log(response.responseText)
                }
            });
        });
        $('#activity').change(function () {
            if ($(this).val() != '') {
                $('#send').attr('disabled', false);
            } else {
                $('#send').attr('disabled', true);
            }
        });
    </script>
@endsection