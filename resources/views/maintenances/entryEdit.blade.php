@extends('layouts.app')

@section('content')
<div class="container text">
    <div class="row justify-content-between">
        <div class="col-sm-5 titles">
            Редактирование расписания работ
        </div>
    </div>
    <form action="{{ route('maintenanceEntries.update', $maintenanceEntry) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        @include('maintenances.entryForm')
    </form>
</div>
@endsection