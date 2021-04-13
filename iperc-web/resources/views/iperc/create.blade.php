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
                    <h3>AGREGAR LINEA O CELDA DEL ARCHIVO:</h3>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            {{ Form::open(['route' => 'iperc.store']) }}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Selecciona el archivo y continua la secuencia:</label>
                            <select name="file" id="file" class="form-control form-control-sm basic" required>
                                <option value="">Seleccione un Archivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Puesto de Trabajo</label>
                            <select name="job_position" id="job-position" class="form-control form-control-sm basic" required>
                                <option value="">Seleccione un Puesto de Trabajo</option>
                                {{-- @foreach ($jobPositions as $jobPosition)
                                    <option value="{{ $jobPosition->id }}">{{ $jobPosition->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Área</label>
                            <select name="area" id="area" class="form-control form-control-sm basic" required>
                                <option value="">Seleccione una Área</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Zona</label>
                            <select name="zone" id="zone" class="form-control form-control-sm basic" required>
                                <option value="">Selecciones una Zona</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Sub-Proceso</label>
                            <select name="sub_process" id="sub-process" class="form-control form-control-sm basic" required>
                                <option value="">Selecciones un Sub-Proceso</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Actividad</label>
                            <select name="activity" id="activity" class="form-control form-control-sm basic" required>
                                <option value="">Selecciones una Actividad</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Tarea</label>
                            <select name="task" id="task" class="form-control form-control-sm basic" required>
                                <option value="">Selecciones una Tarea</option>
                            </select>
                            @error('task')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                @include('iperc.partials.form')
                <div class="row mt-4">
                    <div class="col-12 mt-4">
                        <a href="{{ route('iperc.index') }}" class="btn btn-danger mr-2">Cancelar</a>
                        <button type="submit" class="btn btn-danger mr-2">Guardar</button>
                        {{-- <button type="reset" class="btn btn-danger">Borrar</button> --}}
                    </div>
                </div>
            {!! Form::close() !!}
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

        $('#danger_description').attr('disabled', true);
        $('#consequence').attr('disabled', true);

        $('#danger').change(function () {
            $.ajax({
                type: 'post',
                url: '/danger/get-descriptions',
                data: {
                    _token: '{{ csrf_token() }}',
                    danger: $(this).val()
                },
                dataType: 'json',
                success: function(response) {
                    let option = '<option value="">Selecciones una Descripción del Peligro</option>';
                    for (var i = 0; i < response.length; i++) {
                        option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                    }

                    $('#danger_description').html('');
                    $('#danger_description').append(option);
                    $('#danger_description').attr('disabled', false);
                },
                error: function(response) {
                    console.log(response.responseText)
                }
            }); 
        });
        $('#danger_description').change(function () {
            $.ajax({
                type: 'post',
                url: '/danger/get-event-description',
                data: {
                    _token: '{{ csrf_token() }}',
                    danger: $(this).val()
                },
                dataType: 'json',
                success: function(response) {
                    let option = '<option value="">Selecciones una Descripción del Peligro</option>';
                    for (var i = 0; i < response.length; i++) {
                        option += '<option value="' + response[i].id + '">' + response[i].event + '</option>';
                    }

                    $('#event').html('');
                    $('#event').append(option);
                    $('#event').attr('disabled', false);
                },
                error: function(response) {
                    console.log(response.responseText)
                }
            }); 
        });
        $('#event').change(function () {
            $.ajax({
                type: 'post',
                url: '/danger/get-consequences',
                data: {
                    _token: '{{ csrf_token() }}',
                    danger_description: $('#danger_description').val()
                },
                dataType: 'json',
                success: function(response) {
                    let option = '<option value="">Selecciones un Mayor Daño Lógico Posible</option>';
                    for (var i = 0; i < response.length; i++) {
                        option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                    }

                    $('#consequence').html('');
                    $('#consequence').append(option);
                    $('#consequence').attr('disabled', false);
                },
                error: function(response) {
                    console.log(response.responseText)
                }
            }); 
        });


        /****/
        $('#area').attr('disabled', true);
        $('#sub-process').attr('disabled', true);
        $('#zone').attr('disabled', true);
        $('#activity').attr('disabled', true);
        $('#task').attr('disabled', true);
        $('#job-position').change(function () {
            let file = $(this).val();

            $.ajax({
                type: 'post',
                url: '/iperc/get-area/' + file,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    let option = '<option value="">Seleccione una Área de Trabajo</option>';
                    for (var i = 0; i < response.length; i++) {
                        option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
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
            let file = $(this).val();

            $.ajax({
                type: 'post',
                url: '/iperc/get-zone/' + file,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    let option = '<option value="">Seleccione una Zona de Trabajo</option>';
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
            $.post('/api/get-sub-processes?key=a4bbc5f9e21b96da90df40bd89f8d9fa097f384d&zone='+ $('#zone').val(), function(response) {
                let option = '<option value="">Seleccione un Sub-Proceso</option>';
                for (var i = 0; i < response.length; i++) {
                    option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }

                $('#sub-process').html('');
                $('#sub-process').append(option);
                $('#sub-process').attr('disabled', false);
            }, 'json');
        });
        $('#sub-process').change(function () {
            $.post('/api/get-activities?key=a4bbc5f9e21b96da90df40bd89f8d9fa097f384d&sub_process='+ $('#sub-process').val(), function(response) {
                let option = '<option value="">Seleccione un Sub-Proceso</option>';
                for (var i = 0; i < response.length; i++) {
                    option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }

                $('#activity').html('');
                $('#activity').append(option);
                $('#activity').attr('disabled', false);
            }, 'json');
        });
        $('#activity').change(function () {
            $.post('/api/get-tasks?key=a4bbc5f9e21b96da90df40bd89f8d9fa097f384d&activity='+ $('#activity').val(), function(response) {
                let option = '<option value="">Seleccione una Actividad</option>';
                for (var i = 0; i < response.length; i++) {
                    option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }

                $('#task').html('');
                $('#task').append(option);
                $('#task').attr('disabled', false);
            }, 'json');
        });
        $('#file').select2({
            language: "es",
            ajax: {
                delay: 250,
                url: '/iperc/files/get',
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term,
                        page: params.page || 1
                    }
                },
            }
        });

        $('#file').change(function () {
            let file = $(this).val();

            $.ajax({
                type: 'post',
                url: '/iperc/get-job/' + file,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    let option = '<option value="">Seleccione un Puesto de Trabajo</option>';
                    for (var i = 0; i < response.length; i++) {
                        option += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                    }

                    $('#job-position').html('');
                    $('#job-position').append(option);
                },
                error: function(response) {
                    console.log(response.responseText)
                }
            }); 
        });
    </script>
@endsection