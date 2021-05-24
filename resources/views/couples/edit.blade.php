@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-5 titles">
            Редактирование пар
        </div>
    </div>
    <div class="row mt-3">
        @if (session('error'))
        <div class="alert alert-danger col-sm-4" role="alert">
            Начало пары не может быть позже завершения
        </div>
        @endif
    </div>
    <form action="{{ route('couples.update', $schedule) }}" method="POST" class="mt-3 text">
        @csrf
        @method('PUT')
        @foreach ($schedule->couples as $couple)
        <div class="form-inline mb-3">
            {{ $loop->index + 1 }}-я пара: <input type="time" class="form-control form-control-sm mx-2 mr-sm-2"
                value="{{ $couple->start->format('H:i') ?? '' }}" name="starts[]" required>
            - <input type="time" class="form-control form-control-sm mx-2 mr-sm-2"
                value="{{ $couple->end->format('H:i') ?? '' }}" name="ends[]" required>
        </div>
        @endforeach

        <button type="submit" class="btn btn-success mt-2">Сохранить</button>
    </form>
</div>
@endsection