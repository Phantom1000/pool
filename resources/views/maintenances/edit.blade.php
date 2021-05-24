@extends('layouts.app')

@section('content')
<div class="container text">
    <div class="row justify-content-between">
        <div class="col-sm-5 titles">
            Редактирование работы
        </div>
    </div>
    <form action="{{ route('maintenances.update', $maintenance) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        @include('maintenances.form')
    </form>
</div>
@endsection