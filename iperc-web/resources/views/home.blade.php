@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/apexcharts.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="row h-100vh">
        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing h-100vh">
            <div class="widget widget-chart-one p-4" style="background: #fff;">
                <div class="widget-heading text-center">
                    @if (auth()->user()->isSuperadmin())
                        <h5 class=""><strong>CONSULTAS POR SEDES</strong></h5>
                    @else
                        <h5 class=""><strong>CONSULTAS POR ÁREAS</strong></h5>
                    @endif
                </div>
        
                <div class="widget-content">
                    <div class="tabs tab-content">
                        <div id="content_1" class="tabcontent"> 
                            <div id="revenueMonthly2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow widget-chart-two p-4 mb-4" style="background: #fff;">
                <div class="widget-heading text-center">
                    <h5 class="">CONSULTAS DE HOY</h5>
                </div>
                <div class="widget-content text-center">
                    <p style="font-size: 40px">{{ $requests }}</p>
                    <small>{{ Jenssegers\Date\Date::now()->format("d \\de F \\de  Y") }}</small>
                </div>
            </div>
            <div class="statbox widget box box-shadow widget-chart-two p-4 mb-4" style="background: #fff;">
                <div class="widget-heading text-center mb-3">
                    <h5 class="">IPERC Agregados</h5>
                </div>
                <div class="widget-content text-center">
                    @if (auth()->user()->isSuperAdmin())
                        <ul class="list-group mt-2">
                            @foreach ($headquarters as $h)
                                <li class="list-group-item text-black"><strong>{{ $h->name }}:</strong> {{ $h->files->count() }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p style="font-size: 40px">{{ auth()->user()->headquarter->files->count() }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
                }
            });
            $.ajax({
                url:'/reportes/get/home',
                type:'post',
                success: function (response) {
                    if (response['status'] == true) {
                        generateChart2(response['series'], response['dates'])
                    }
                },
                error:function(response){
                    console.log(response);
                }
            });
        });

        function generateChart2(series, dates) {
            var sLineArea = {
            chart: {
                width: '100%',
                height: 500,
                type: 'area',
                toolbar: {
                    show: false,
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            colors:['#008FFB', '#00E396', '#FEB019', '#FF4560','#775DD0', '#C0392B'],
            series: series,
            legend: {
                position: 'right',
                // horizontalAlign: 'right',
                itemMargin: {
                    horizontal: 5,
                    vertical: 5
                },
                width: "180px",
            },
            xaxis: {
                categories: dates,
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            },
            responsive: [
                {
                    breakpoint: 1000,
                    options: {
                        plotOptions: {
                            bar: {
                                horizontal: false
                            }
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }
            ]
        }

        var chart = new ApexCharts(
            document.querySelector("#revenueMonthly2"),
            sLineArea
        );

        chart.render();
        }
    </script>
@endsection