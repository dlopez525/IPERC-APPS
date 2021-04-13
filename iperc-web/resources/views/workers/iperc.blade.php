@extends('layouts.workers', ['soda' => '6', 'putLogo' => false, 'putBack' => true, 'date' => $ipercs[0]['last_update'] ])
@section('title', 'IPERC')
{{-- @section('date', {{ $ipercs[0]->last_update }} ) --}}
@section('content')
    <div class="section-form">
        <div class="row">
            <div class="col-12">
                <h5 class="page-title">Descripción del Peligro</h5>
            </div>
        </div>
        <div class="accordion" id="accordionIperc">
            @for ($i = 0; $i < count($ipercs); $i++)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left accordion-toggle" type="button" data-toggle="collapse" data-target="#collapse{{ $ipercs[$i]['id'] }}" aria-expanded="false" aria-controls="collapse{{ $ipercs[$i]['id'] }}">
                                {{ $ipercs[$i]['danger_description'] }}
                            </button>
                        </h2>
                    </div>
            
                    <div id="collapse{{ $ipercs[$i]['id'] }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionIperc">
                        <div class="card-body">
                            @if (count($ipercs[$i]['dangers_descriptions']) > 1)
                                <div class="accordion sub-accordion" id="subAccordionIperc">
                                    @for ($x = 0; $x < count($ipercs[$i]['dangers_descriptions']); $x++)
                                        <div class="card">
                                            <div class="card-header" id="subHeadingOne">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block text-left accordion-toggle" type="button" data-toggle="collapse" data-target="#collapse{{ $ipercs[$i]['dangers_descriptions'][$x]['id'] }}" aria-expanded="false" aria-controls="collapse{{ $ipercs[$i]['dangers_descriptions'][$x]['id'] }}">
                                                        {{ $ipercs[$i]['dangers_descriptions'][$x]['event'] }}
                                                    </button>
                                                </h2>
                                            </div>
                                    
                                            <div id="collapse{{ $ipercs[$i]['dangers_descriptions'][$x]['id'] }}" class="collapse" aria-labelledby="subHeadingOne" data-parent="#subAccordionIperc">
                                                <div class="card-body">
                                                    <div class="accordion-body-custom">
                                                        <h5 class="page-title">Mayo daño lógico posible (consecuencias)</h5>
                                                        <p class="accordion-body-text">{{ $ipercs[$i]['dangers_descriptions'][$x]['consequence'] }}</p>
                                                    </div>
                                                    <div class="accordion-body-custom jc">
                                                        <div class="danger-indicator d-flex align-items-center {{ $ipercs[$i]['dangers_descriptions'][$x]['risk_name'] }}"><span>{{ $ipercs[$i]['dangers_descriptions'][$x]['risk'] }}</span></div>
                                                        <a href="{{ route('workers.controls', $ipercs[$i]['dangers_descriptions'][$x]['id']) }}" class="custom-btn-primary no-100 mt-5">Ver Controles</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @else
                                <div class="accordion-body-custom">
                                    <h5 class="page-title">Descripción del evento Peligroso</h5>
                                    <p class="accordion-body-text">{{ $ipercs[$i]['dangers_descriptions'][0]['event'] }}</p>
                                </div>
                                <div class="accordion-body-custom">
                                    <h5 class="page-title">Mayo daño lógico posible (consecuencias)</h5>
                                    <p class="accordion-body-text">{{ $ipercs[$i]['dangers_descriptions'][0]['consequence'] }}</p>
                                </div>
                                <div class="accordion-body-custom jc">
                                    <div class="danger-indicator d-flex align-items-center {{ $ipercs[$i]['dangers_descriptions'][0]['risk_name'] }}"><span>{{ $ipercs[$i]['dangers_descriptions'][0]['risk'] }}</span></div>
                                    <a href="{{ route('workers.controls', $ipercs[$i]['dangers_descriptions'][0]['id']) }}" class="custom-btn-primary no-100 mt-5">Ver Controles</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        $('.accordion .card-header .accordion-toggle').click(function() {
            if ($(this).attr('aria-expanded') == 'true') {
                $(this).parent().parent().removeClass('active');     
            } 
            if ($(this).attr('aria-expanded') == 'false') {
                $(this).parent().parent().addClass('active');     
            }
        });
        $('.sub-accordion .card-header .accordion-toggle').click(function() {
            if ($(this).attr('aria-expanded') == 'true') {
                $(this).parent().parent().removeClass('active');     
            } 
            if ($(this).attr('aria-expanded') == 'false') {
                $(this).parent().parent().addClass('active');     
            }
        });
    </script>
@endsection