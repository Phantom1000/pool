@extends('layouts.app')

@section('content')
<div class="container text">
    <div class="row justify-content-between">
        <div class="col-sm-5 titles">
            Редактирование зала
        </div>
    </div>
    <form action="{{ route('halls.update', $hall) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        @include('halls.form')
    </form>
</div>
@endsection