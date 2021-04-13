@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dt-global_style.css')}}">
@endsection
@section('content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header py-3 px-3">
            <div class="row">
                <div class="col-12">
                    <h4>Administradores</h4>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="btn btn-danger" data-toggle="modal" data-target="#createHeadquarter">Nuevo Administrador</div>
                </div>
            </div>
        </div>
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
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive mb-4 mt-4">
                <table id="zero-config" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sede</th>
                            <th>SAP</th>
                            <th>Nombres y Apellidos</th>
                            <th>Email</th>
                            <th>Tipo de Usuario</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->headquarter_id != null ? $user->headquarter->name : '' }}</td>
                                <td>{{ $user->sap }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->type_user  == 0 ? 'Super Administrador' : 'Administrador' }}</td>
                                <td>
                                    @if ($user->id != 2)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit table-edit" data-id="{{ $user->id }}"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel" data-id="{{ $user->id }}"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createHeadquarter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Administrador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                  </button>
            </div>
            <form action="{{ route('usersadmin.save') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="user_id" name="user_id">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sap">SAP</label>
                        <input type="text" name="sap" id="sap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Tipo de Usuario</label>
                        <select name="type" id="type" class="form-control">
                            <option value="1">Administrador</option>
                            <option value="0">Super Administrador</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="headquarter">Sede</label>
                        <select name="headquarter_id" id="headquarter_id" class="form-control" required>
                            @foreach ($headquarters as $headquarter)
                                <option value="{{ $headquarter->id }}">{{ $headquarter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" id="close-modal" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
<script>
    $('#zero-config').DataTable({
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
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7 
    });

    $('body').on('click', '.table-edit', function () {
        let id = $(this).data('id');
        $.ajax({
            type: 'post',
            url: '/usuarios/administradores/get',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: id 
            },
            dataType: 'json',
            success: function(response) {
                $('#user_id').val(response.id);
                $('#name').val(response.name);
                $('#sap').val(response.sap);
                $('#email').val(response.email);
                $('#headquarter_id').val(response.headquarter_id);
                $('#type').val(response.type_user);
            },
            error: function(response) {
                console.log(response.responseText)
            }
        }); 

        $('#createHeadquarter').modal('show');
    });
    $('body').on('click', '.table-cancel', function () {
        let id = $(this).data('id');
        if (confirm('¿Desea Eliminar este Usuario?')) {
            $.ajax({
                type: 'post',
                url: '/usuarios/administradores/delete',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: id 
                },
                dataType: 'json',
                success: function(response) {
                    if (response == true) {
                        location.href = '/usuarios/administradores';
                    }
                },
                error: function(response) {
                    console.log(response.responseText)
                }
            });
        }
    });

    $("#createHeadquarter").on('hidden.bs.modal', function () {
        $('#user_id').val('');
        $('#name').val('');
        $('#sap').val('');
        $('#email').val('');
        $('#headquarter_id').val('');
    });
</script>
@endsection