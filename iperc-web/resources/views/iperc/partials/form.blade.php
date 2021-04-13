<div class="row">
    <div class="col-12 col-md-6">
        <label>Tipo de Trabajo</label>
        <div class="mt-3">
            <div class="custom-control custom-radio custom-control-inline">
                {{ Form::radio('type_job', '1', null,['id' => 'rutinary','class' => 'custom-control-input', 'required' => 'required']) }}
                <label class="custom-control-label" for="rutinary">Rutinario</label>
                </div>
            <div class="custom-control custom-radio custom-control-inline">
                {{ Form::radio('type_job', '2', null,['id' => 'norurinary', 'class' => 'custom-control-input', 'required' => 'required']) }}
                <label class="custom-control-label" for="norurinary">No Rutinario</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                {{ Form::radio('type_job', '3', null,['id' => 'emergency', 'class' => 'custom-control-input', 'required' => 'required']) }}
                <label class="custom-control-label" for="emergency">Emergencia</label>
            </div>
            @error('type_job')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label>Tipo de Peligro</label>
        {{ Form::select('danger_id', $dangers, null, ['class' => 'form-control basic','placeholder' => 'Seleccione un Tipo de Peligro', 'id' => 'danger', 'required' => 'required']) }}
        @error('danger_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-4">
        <label>Descripcion del Peligro</label>
        {{ Form::select('danger_description_id', $descriptions, null, ['class' => 'form-control basic','placeholder' => 'Selecciona una Descripcion del Peligro', 'id' => 'danger_description', 'required' => 'required']) }}
        @error('danger_description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-12 col-md-4">
        <label>Descripcion del Evento Peligroso</label>
        {{ Form::select('event', $events, null, ['class' => 'form-control basic','id' => 'event', 'required' => 'required']) }}
    </div>
    <div class="col-12 col-md-4">
        <label>Mayor Daño Logico Posible</label>        
        {{ Form::select('consequence_id', $consequences, null, ['class' => 'form-control basic','placeholder' => 'Selecciona una Descripcion del Peligro', 'id' => 'consequence', 'required' => 'required']) }}
        @error('consequence')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 mb-3">
        <h4>Controles Existentes</h4>
    </div>
    <div class="col-12 mb-3">
        <label>Controles de Ingeniería</label>
        {{ Form::textarea('engineering_controls', null, ['class' => 'form-control form-control-sm']) }}        
    </div>
    <div class="col-12 mb-3">
        <label>Controles Administrativos</label>
        {{ Form::textarea('administrative_controls', null, ['class' => 'form-control form-control-sm']) }}
    </div>
    <div class="col-12 mb-3">
        <label>EPP's</label>
        {{ Form::textarea('epps', null, ['class' => 'form-control form-control-sm']) }}
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 mb-3">
        <h4>Evaluación del Riesgo</h4>
    </div>
    <div class="col-12 col-md-3 mb-3">
        <label>Consecuencia</label>
        {{ Form::select('consequence_evaluation', ['100' => '100', '50' => '50','25' => '25','15' => '15', '5' => '5', '1' => '1'], null, ['id' => 'consecuence', 'class' => 'form-control','placeholder' => 'Consecuencia', 'required' => 'required']) }}
        @error('consequence_evaluation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-12 col-md-3 mb-3">
        <label>Exposición</label>
        {{ Form::select('exhibition_evaluation', ['10' => '10', '6' => '6','3' => '3','2' => '2', '1' => '1', '0.5' => '0.5'], null, ['id' => 'exposition', 'class' => 'form-control','placeholder' => 'Exposición', 'required' => 'required']) }}
        @error('exhibition_evaluation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-12 col-md-3 mb-3">
        <label>Probabilidad</label>
        {{ Form::select('probability_evaluation', ['10' => '10', '6' => '6','3' => '3', '1' => '1', '0.5' => '0.5','0.1' => '0.1'], null, ['id' => 'probability', 'class' => 'form-control','placeholder' => 'Probabilidad', 'required' => 'required']) }}
        @error('probability_evaluation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-12 col-md-3 mb-3">
        <label>Grado de Peligrosidad</label>
        {{ Form::text('total_evaluation', null, ['id' => 'grade','class' => 'form-control form-control-sm', 'id' => 'grade', 'step' => '0.1', 'readonly' => true,'required' => 'required']) }}
    </div>
</div>