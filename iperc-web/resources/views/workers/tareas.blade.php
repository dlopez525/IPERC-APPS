@extends('layouts.workers', ['soda' => '4', 'putLogo' => true, 'putBack' => true, 'date' => ''])
@section('title', 'Tareas')
@section('content')
    <div class="section-form">
        <form action="{{ route('tasks.process') }}" id="form" method="POST">
            @csrf
            <div class="custom-form-group">
                <label class="custom-form-label">Seleccione una Tarea</label>
                <select name="task" id="task" class="custom-form-control s2" required>
                    <option value="">Seleccione una Tarea</option>
                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->name }}</option>
                    @endforeach
                </select>
                <br>
                <p class="information mt-3">
                    Estas son las tareas que están relacionadas
                    a la actividad seleccionada, elije una para
                    consultar sus peligros, riesgos y medidas
                    de controles.
                </p>
            </div>
            <div class="form-group">
                <button class="custom-btn-primary" type="submit">Continuar</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#task').val(localStorage.task).trigger('change');
            console.log(localStorage.task);
        });

        $('#form').submit(function() {
            localStorage.task = $('#task').val();
        });
    </script>
@endsection