@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dt-global_style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection
@section('content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header py-3 px-3">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h4>EDITAR - ELIMINAR LINEA O CELDA DEL ARCHIVO</h4>
                </div>
                <div class="col-12 col-lg-4">
                    <a href="{{ route('iperc.create') }}" class="btn btn-danger float-lg-right">Adicionar Línea</a>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    {{-- <div class="btn btn-danger" data-toggle="modal" data-target="#import-user">Importar IPERC</div> --}}
                    {{-- <div class="btn btn-danger" type="button">Descargar IPERC</div> Descargar IPERC ACTUALIZADO - Descargar IPERC --}}
                    {{-- <a href="{{ route('iperc.files') }}" class="btn btn-danger">Archivos Subidos</a> --}}
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <input type="hidden" id="isa" value="{{ auth()->user()->isSuperAdmin() ? 1 : 0 }}">
            <div class="row">
                <div class="col-12" id="messages">
                    @if (session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {!! session('error') !!}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {!! session('warning') !!}
                        </div>
                    @endif
                    <div class="alert alert-success" id="alert-success-js"></div>
                    <div class="alert alert-danger" id="alert-danger-js"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Selecciona el archivo y continua la secuencia:</label>
                        <select name="file" id="file" class="form-control form-control-sm basic" required>
                            <option value="">Seleccione un Archivo</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="form-group">
                        <label>Puesto de Trabajo</label>
                        <select name="job_position" id="job-position" class="form-control form-control-sm basic">
                            <option value="">Seleccione un Puesto de Trabajo</option>
                            {{-- @foreach ($jobPositions as $jobPosition)
                                <option value="{{ $jobPosition->id }}">{{ $jobPosition->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="form-group">
                        <label>Área</label>
                        <select name="area" id="area" class="form-control form-control-sm basic">
                            <option value="">Seleccione una Área</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="form-group">
                        <label>Zona</label>
                        <select name="zone" id="zone" class="form-control form-control-sm basic">
                            <option value="">Selecciones una Zona</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="form-group">
                        <label>Sub-Proceso</label>
                        <select name="sub_process" id="sub-process" class="form-control form-control-sm basic">
                            <option value="">Selecciones un Sub-Proceso</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="form-group">
                        <label>Actividad</label>
                        <select name="activity" id="activity" class="form-control form-control-sm basic">
                            <option value="">Selecciones una Actividad</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="form-group">
                        <label>Tarea</label>
                        <select name="task" id="task" class="form-control form-control-sm basic">
                            <option value="">Selecciones una Tarea</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <button class="btn btn-danger" id="clear-filters" type="reset">Limpiar Selección</button>
                </div>
            </div>
            <div class="table-responsive mb-4 mt-2">
                <table id="zero-config" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tarea</th>
                            <th width="180px">Peligro</th>
                            <th width="230px">Descripción del Peligro</th>
                            <th width="230px">Descripción del Evento</th>
                            <th width="180px">Riesgo</th>
                            {{-- <th width="250px">Última Actualización</th> --}}
                            <th width="55px">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/custom-select2.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#alert-success-js').hide();
        $('#alert-danger-js').hide();
    });
    $('#importForm').submit(function(){
        $('#importBtn').prop('disabled', true);
        $('#importCancel').prop('disabled', true);
    });

    let tbl = $('#zero-config').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Mostrando página _PAGE_ de _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Buscar...",
           "sLengthMenu": "Resultados :  _MENU_",
           "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sLoadingRecords": "Cargando...",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
        },
        "stripeClasses": [],
        "lengthMenu": [10, 20, 50],
        "pageLength": 10,
        'processing': false,
        'serverSide': true,
        'ajax': {
            'url': '/iperc/dt',
            'type' : 'get',
            'data': function(d) {
                d.task = $('#task').val();
            }
        },
        'columns': [
            {
                data: 'task.name'
            },
            {
                data: 'danger.name'
            },
            {
                data: 'danger_description.name'
            },
            {
                data: 'danger_description.event'
            },
            {
                data: 'risk.name'
            },
            // {
            //     data: 'updated_at'
            // },
            {
                data: 'id'
            }
        ],
        'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            // $(nRow).find("td:eq(3)").text(moment(aData['updated_at']).format("DD-MM-YYYY H:m"));
            $(nRow).find("td:eq(5)").html(`
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit table-edit" data-id="`+ aData['id']+`"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel" data-id="`+ aData['id'] +`"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`);
        }
    });
    $('#task').change(function() {
        tbl.ajax.reload();
    });

    $('body').on('click', '.table-cancel', function(e) {
        let id = $(this).data('id');
        $.ajax({
            type: 'post',
            url: '/iperc/delete',
            data: {
                _token: '{{ csrf_token() }}',
                el: id 
            },
            dataType: 'json',
            success: function(response) {
                if (response == true) {
                    tbl.ajax.reload();
                    $('#messages .alert-success').text('Se eliminó correctamente');
                    $('.alert-success').show();
                } else {
                    $('#messages .alert-danger').text('Ooops. Hubo un problema intentelo nuevamente.')
                    $('.alert-danger').show();
                }
            },
            error: function(response) {
                console.log(response.responseText)
                $('#messages .alert-danger').text('Ooops. Hubo un problema intentelo nuevamente.');
                $('.alert-danger').show();
            }
        });
    });
    $('body').on('click', '.table-edit', function(e) {
        let id = $(this).data('id');
        
        window.location.href = '/iperc/editar/' + id;
    });

    $('#clear-filters').click(function() {
        $(".basic").select2('destroy');
        $('#area').val('');
        $('#sub-process').val('');
        $('#zone').val('');
        $('#activity').val('');
        $('#job-position').val('');
        $('#task').val('');

        $('#sub-process').attr('disabled', true);
        $('#zone').attr('disabled', true);
        $('#activity').attr('disabled', true);
        $('#job-position').attr('disabled', true);
        $('#task').attr('disabled', true);
        
        tbl.ajax.reload();
        $(".basic").select2();
    });

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
            let option = '<option value="">Seleccione una Actividad</option>';
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