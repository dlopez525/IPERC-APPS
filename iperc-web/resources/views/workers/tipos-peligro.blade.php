@extends('layouts.workers', ['soda' => '5', 'putLogo' => false, 'putBack' => true, 'date' => ''])
@section('title', 'Tipos de Peligro')
@section('content')
    <div class="section-form">
        <form action="{{ route('taskdanger.process') }}" method="POST">
            @csrf
            <div class="custom-form-group" style="margin-bottom: 0">
                <p>Selecciona y haz clic en continuar</p>
                <ul class="danger-list">
                    <input type="hidden" name="task" value="{{ $tarea }}">
                    @foreach ($dangers as $danger)
                        <li>
                            <input type="radio" id="myCheckbox{{ $danger->name }}" value="{{ $danger->id }}" name="danger">
                            <label for="myCheckbox{{ $danger->name }}">
                                <img src="{{ asset($danger->img) }}">
                                <p>{{ $danger->name }}</p>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group mb-4">
                <button class="custom-btn-primary" id="send" type="submit">Continuar</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $('#send').attr('disabled', true);
        $('input[type=radio]').on('change', function() {
            if ($(this).is(':checked') ) {
                $('#send').attr('disabled', false);
            } else {
                $('#send').attr('disabled', true);
            }
        });
    </script>
@endsection