@extends('layouts.app')

@section('content')
<div class="container text">
    <div class="row justify-content-between">
        <div class="col-sm-5 titles">
            Добавление зала
        </div>
    </div>
    <form action="{{ route('halls.store') }}" method="POST" class="mt-3">
        @csrf

        @include('halls.form')
    </form>
</div>
@endsection