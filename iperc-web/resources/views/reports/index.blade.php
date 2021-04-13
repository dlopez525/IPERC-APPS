@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('css/apexcharts.css') }}">
@endsection
@section('content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header py-3 px-3">
            <div class="row">
                <div class="col-12">
                    <h4>Reportes</h4>
                </div>
            </div>
            <div class="row mb-4">
                <input type="hidden" id="isa" value="{{ auth()->user()->isSuperAdmin() ? 1 : 0 }}">
                @if (auth()->user()->isSuperAdmin())
                    <div class="col-4 col-lg-3">
                        <label>Sede</label>
                        <select name="headquarter" id="headquarter" class="form-control">
                            @foreach ($headquarters as $headquarter)
                                <option value="{{ $headquarter->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $headquarter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="col-4 col-lg-3">
                    <label>Fechas</label>
                    <input type="text" class="form-control form-control" id="dates" name="dates" value="01/01/2018 - 01/15/2018" />
                </div>
                <div class="col-4 col-lg-3 mt-4">
                    <div class="btn btn-danger mt-2" id="generateReport">Generar Reporte</div>
                    {{-- <div class="btn btn-danger mt-2" data-toggle="modal" data-target="#createHeadquarter">Exportar a Excel</div> --}}
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div id="content_1" class="tabcontent"> 
                <div id="revenueMonthly"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('js/apexcharts.min.js') }}"></script>
<script>
    $('#generateReport').click(function () {
        let data = {}
        if ($('#isa').val() == 1) {
            data = {
                dates: $('#dates').val(),
                headquarter: $('#headquarter').val(),
            }
        } else {
            data = {
                dates: $('#dates').val(),
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        });
        $.ajax({
            url:'/reportes/get/index',
            data: data,
            type:'post',
            success: function (response) {
                if (response['status'] == true) {
                    $('#revenueMonthly').hide();
                    generateChart(response['series'], response['dates'])
                    $('#revenueMonthly').show();
                }
            },
            error:function(response){
                console.log(response);
            }
        });
    });

    function generateChart(series, dates) {
        var sCol = {
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'  
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: series,
            xaxis: {
                categories: dates,
            },
            yaxis: {
                title: {
                    text: 'Consultas'
                }
            },
            fill: {
                opacity: 1

            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " consultas"
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#revenueMonthly"),
            sCol
        );
        chart.render();
    }
</script>
<script>
    $(function() {
        $('input[name="dates"]').daterangepicker({
            opens: 'left',
            startDate: moment().subtract(7, 'days'),
            endDate: moment().add(1, 'days'),
            locale: {
                format: 'DD/MM/YYYY',
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "Desde",
                "toLabel": "Hasta",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Deciembre"],
                "firstDay": 1
            }
        });
    });
</script>
@endsection