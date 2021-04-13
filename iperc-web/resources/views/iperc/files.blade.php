@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dt-global_style.css')}}">
    <style>.pointer {cursor: pointer;color: green;}</style>
@endsection
@section('content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header py-3 px-3">
            <div class="row">
                <div class="col-12">
                    <h4>Lista de Archivos</h4>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="btn btn-danger" data-toggle="modal" data-target="#import-user">Subir Excel</div>
                    <a href="{{ route('iperc.logs') }}" class="btn btn-danger" >Historial</a>
                    {{-- <a href="{{ route('iperc.create') }}" class="btn btn-danger" >Inclusiones IPERC</a> --}}
                    {{-- <div class="btn btn-danger" type="button">Descargar IPERC</div> Descargar IPERC ACTUALIZADO - Descargar IPERC --}}
                    {{-- <a href="{{ route('iperc.files') }}" class="btn btn-danger">Archivos Subidos</a> --}}
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            
            <div class="row">
                <div class="col-12" id="messages">
                    @if (session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
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
            <div class="table-responsive mb-4 mt-2">
                <table id="zero-config" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Nombre de Archivo</th>
                            <th scope="col">Fecha y Hora</th>
                            <th scope="col">Subido Por</th>
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
<div class="modal fade" id="import-user" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('iperc.import') }}" method="POST" id="importForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Archivos Subidos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Subir Archivo</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal" id="importCancel">Cerrar</button>
                    <button type="submit" class="btn btn-danger" id="importBtn">Importar</button>
                </div>
            </div>
        </form>
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
            'url': '/iperc/files/dt',
            'type' : 'get',
            'data': function(d) {
                d.task = $('#task').val();
            }
        },
        'columns': [
            {
                data: 'name'
            },
            {
                data: 'created_at'
            },
            {
                data: 'user.sap'
            },
            {
                data: 'id'
            }
        ],
        'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $(nRow).find("td:eq(1)").text(moment(aData['created_at']).format("DD-MM-YYYY H:m"));
            $(nRow).find("td:eq(3)").html(`
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download file pointer"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel" data-id="`+ aData['id'] +`"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            `);
        }
    });

    $('body').on('click', '.table-cancel', function() {
        let id = $(this).data('id');
        if (confirm('¿Desea Eliminar este Archivo?')) {
            $.ajax({
                type: 'post',
                url: '/iperc/files/delete',
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
        }
    });

    $('body').on('click','.file',function(e) {
        e.preventDefault();
        let data = tbl.row( $(this).parents('tr') ).data();
        window.open('/iperc/export?file=' + data['id'], '_blank');
    });
</script>
@endsection