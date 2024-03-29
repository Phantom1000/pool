@extends('layouts.app')

@section('content')
<div class="container text">
    <div class="row justify-content-between">
        <div class="col-sm-5 titles">
            Редактирование раписания
        </div>
    </div>
    <form action="{{ route('schedules.update', $schedule) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        @include('schedules.form')
    </form>
</div>
@endsection