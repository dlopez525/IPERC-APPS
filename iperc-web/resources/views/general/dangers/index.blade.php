@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dt-global_style.css')}}">
    <style>
        .vodiapicker{
            display: none; 
        }
        #a{
            padding-left: 0px;
        }
        #a img, .btn-select img{
            width: 30px;
            height: 30px;
        }
        #a li{
            list-style: none;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
            cursor: pointer;
        }
        #a li:hover{
            background-color: #F4F3F3;
        }
        #a li img{
            margin: 5px;
        }
        #a li span, .btn-select li span{
        margin-left: 30px;
        }
        .b{
            display: none;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 6px 12px rgba(0,0,0,.175);
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 5px;
            position: absolute;
            background: #fff;
            z-index: 9999;
        }
        .open{
            display: show !important;
        }
        .btn-select{
            border: 1px solid #bfc9d4;
            color: #3b3f5c;
            font-size: 15px;
            padding: 8px 10px;
            letter-spacing: 1px;
            height: calc(1.4em + 1.4rem + 2px);
            padding: .75rem 1.25rem;
            border-radius: 6px;
            width: 100%;
            background: #fff;
        }
        .btn-select li{
            list-style: none;
            float: left;
            padding-bottom: 0px;
        }
        .btn-select:hover li{
            margin-left: 0px;
        }
        .btn-select:hover{
            background-color: #F4F3F3;
            border: 1px solid transparent;
            box-shadow: inset 0 0px 0px 1px #ccc;
        }
        .btn-select:focus{
            outline:none;
        }
        .lang-select {
            position: relative;
        }
    </style>
@endsection
@section('content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header py-3 px-3">
            <div class="row">
                <div class="col-12">
                    <h4>Peligros</h4>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="btn btn-danger" data-toggle="modal" data-target="#create">Nuevo Peligro</div>
                    <a href="{{ route('description.index') }}" class="btn btn-danger">Descripción de Peligro</a>
                    <a href="{{ route('consequence.index') }}" class="btn btn-danger">Consecuencia</a>
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
                    <div class="alert" id='ajax-message'>
                        
                    </div>
                </div>
            </div>
            <div class="table-responsive mb-4 mt-4">
                <table id="zero-config" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Peligro</th>
                            <th>Imagen</th>
                            <th width="50px">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dangers as $danger)
                            <tr>
                                <td>{{ $danger->name }}</td>
                                <td><img src="{{ asset($danger->img) }}" width="50px" height="50px"></td>
                                <td>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit table-edit" data-id="{{ $danger->id }}"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel" data-id="{{ $danger->id }}"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Peligro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                  </button>
            </div>
            <form action="{{ route('danger.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="el_id" name="el_id">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Imagen Precargada</label>
                        <select class="vodiapicker">
                            <option value="upload" class="test">Selecciona una imagen Precargada</option>
                            <option value="/img/dangers/biologicos.png" class="test" data-thumbnail="/img/dangers/biologicos.png">Biológico</option>
                            <option value="/img/dangers/electricos.png" data-thumbnail="/img/dangers/electricos.png">Eléctricos</option>
                            <option value="/img/dangers/ergonomicos.png" data-thumbnail="/img/dangers/ergonomicos.png">Ergonómicos</option>
                            <option value="/img/dangers/fisico.png" data-thumbnail="/img/dangers/fisico.png">Físicos</option>
                            <option value="/img/dangers/fisicosquimicos.png" data-thumbnail="/img/dangers/fisicosquimicos.png">FísicoQuímicos</option>
                            <option value="/img/dangers/locativos.png" data-thumbnail="/img/dangers/locativos.png">Locativos</option>
                            <option value="/img/dangers/mecanicos.png" data-thumbnail="/img/dangers/mecanicos.png">Mecánicos</option>
                            <option value="/img/dangers/otros.png" data-thumbnail="/img/dangers/otros.png">Otros</option>
                            <option value="/img/dangers/psicosociales.png" data-thumbnail="/img/dangers/psicosociales.png">Psicosociales</option>
                            <option value="/img/dangers/quimicos.png" data-thumbnail="/img/dangers/quimicos.png">Químicos</option>
                        </select>
                        
                        <input type="hidden" id="preload" name="preload" value="-1">
                        <div class="lang-select">
                            <button class="btn-select" type="button" value=""></button>
                            <div class="b">
                                <ul id="a"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Subir Imagen</label>
                        <input type="file" name="file" class="form-control">
                        <small>Tamaño: 501 x 501 píxeles</small>
                    </div>
                    <div class="form-group" id="show-current-img">
                        <label for="">Imagen Actual</label>
                        <img src="" id="danger-img" width="70px" height="70px">
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
    $(document).ready(function () {
        $('#ajax-message').hide();
        $('#show-current-img').hide()
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
        "pageLength": 10 
    });

    $('body').on('click', '.table-edit', function(e) {
        let id = $(this).data('id');
        $.ajax({
            type: 'post',
            url: '/peligros/get',
            data: {
                _token: '{{ csrf_token() }}',
                el_id: id 
            },
            dataType: 'json',
            success: function(response) {
                $('#el_id').val(response.id);
                $('#name').val(response.name);
                $('#danger-img').attr('src',response.img);
                $('#show-current-img').show();
            },
            error: function(response) {
                console.log(response.responseText)
            }
        }); 

        $('#create').modal('show');
    });

    $('body').on('click', '.table-cancel', function(e) {
        let id = $(this).data('id');
        if (confirm('¿Desea Eliminar este Elemento?')) {
            $.ajax({
                type: 'post',
                url: '/peligros/delete',
                data: {
                    _token: '{{ csrf_token() }}',
                    el: id 
                },
                dataType: 'json',
                success: function(response) {
                    if (response == true) {
                        $('#ajax-message').addClass('alert-success');
                        $('#ajax-message').text('Se eliminó correctamente.');
                        $('#ajax-message').show();
                        location.href = '/peligros';
                        
                    }
                },
                error: function(response) {
                    $('#ajax-message').addClass('alert-danger');
                    $('#ajax-message').text('Oops. Ocurrió un problema. Vuelve a Intentarlo.');
                    console.log(response.responseText)
                }
            });
        }
    });

    $("#create").on('hidden.bs.modal', function () {
        $('#el_id').val('');
        $('#name').val('');
        $('#show-current-img').hide();
    });
    $('#filter-sede').change(function() {
        tbl.ajax.reload();
    });

    var langArray = [];
$('.vodiapicker option').each(function(){
  var img = $(this).attr("data-thumbnail");
  var text = this.innerText;
  var value = $(this).val();
  var item = '<li><img src="'+ img +'" alt="" value="'+value+'"/><span>'+ text +'</span></li>';
  langArray.push(item);
})

$('#a').html(langArray);

//Set the button value to the first el of the array
$('.btn-select').html(langArray[0]);
$('.btn-select').attr('value', 'en');

//change button stuff on click
$('#a li').click(function(){
   var img = $(this).find('img').attr("src");
   var value = $(this).find('img').attr('value');
   var text = this.innerText;
   var item = '<li><img src="'+ img +'" alt="" /><span>'+ text +'</span></li>';
  $('.btn-select').html(item);
  $('.btn-select').attr('value', value);
  $(".b").toggle();

  $('#preload').val(value);
});

$(".btn-select").click(function(){
        $(".b").toggle();
    });

//check local storage for the lang
var sessionLang = localStorage.getItem('lang');
if (sessionLang){
  //find an item with value of sessionLang
  var langIndex = langArray.indexOf(sessionLang);
  $('.btn-select').html(langArray[langIndex]);
  $('.btn-select').attr('value', sessionLang);
} else {
   var langIndex = langArray.indexOf('ch');
  console.log(langIndex);
  $('.btn-select').html(langArray[langIndex]);
  //$('.btn-select').attr('value', 'en');
}
</script>
@endsection