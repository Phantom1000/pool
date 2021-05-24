@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <x-admin></x-admin>
            <div class="col-sm-4">
                <form class="form-inline" action="{{ route('maintenances.store') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control mx-2 mr-sm-2 @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-success">Новая работа</button>
                </form>
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
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($maintenances as $maintenance)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>
                                @if (isset($editMaintenance))
                                    <form class="form-inline" action="{{ route('maintenances.update', $maintenance) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text"
                                            class="form-control mx-2 mr-sm-2 @error('title') is-invalid @enderror"
                                            name="title" value="{{ $maintenance->title }}" required>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <button type="submit" class="btn btn-success">Сохранить</button>
                                    </form>
                                @else
                                    {{ $maintenance->name }}
                                @endif
                            </td>
                            <td>
                                <div class="row justify-content-center">
                                    <a href="{{ route('maintenances.edit', $maintenance) }}"
                                        class="mr-2 btn btn-primary">Редактировать</a>
                                    <form action="{{ route('maintenances.destroy', $maintenance) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="mr-2 btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <h1 class="text-center">Пока нет работ</h1>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $maintenances->links() }}
        </div>
    </div>
@endsection
