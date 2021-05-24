@extends('layouts.app')

@section('content')
<div class="container text">
    <div class="row justify-content-between">
        <div class="col-sm-5 titles">
            Составление раписания
        </div>
    </div>
    <form action="{{ route('schedules.store') }}" method="POST" class="mt-3">
        @csrf

        @include('schedules.form', ['schedule' => null])
    </form>
</div>
@endsection