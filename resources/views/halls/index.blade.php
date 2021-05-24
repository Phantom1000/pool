@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        @include('components.admin')
        <div class="col-sm-4">
            <a href="{{ route('halls.create') }}" class="btn btn-success">Новый зал</a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <table class="table table-striped table-dark mt-3 col-sm-9">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Название</th>
                    <th>Этаж</th>
                    <th>Число дорожек</th>
                    <th>Мест на дорожку</th>
                    <th class="text-center">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($halls as $hall)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $hall->name ?? '' }}</td>
                    <td>{{ $hall->floor ?? '' }}</td>
                    <td>{{ $hall->lanes ?? '' }}</td>
                    <td>{{ $hall->places ?? '' }}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{ route('halls.edit', $hall) }}" class="mr-2 btn btn-primary">Редактировать</a>
                            <form action="{{ route('halls.destroy', $hall) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="mr-2 btn btn-danger" type="submit">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <h1 class="text-center">Пока не добавлено ни одного зала</h1>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection