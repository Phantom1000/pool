@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            @include('components.admin')
            <div class="col-sm-4">
                <a href="{{ route('schedules.create') }}" class="btn btn-success">Новое расписание</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <table class="table table-striped table-dark mt-3 col-sm-9">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Зал</th>
                        <th>С</th>
                        <th>По</th>
                        <th>Начало работы</th>
                        <th>Завершение работы</th>
                        <th>Активное</th>
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schedules as $schedule)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $schedule->hall->name }}</td>
                            <td>{{ DateTime::createFromFormat('Y-m-d', $schedule->startdate)->format('d.m.Y') ?? '' }}
                            </td>
                            <td>{{ $schedule->enddate->format('d.m.Y') }}</td>
                            <td>{{ $schedule->starttime->format('H:i') }}</td>
                            <td>{{ $schedule->endtime->format('H:i') }}</td>
                            <td>{{ $schedule->active ? 'Да' : 'Нет' }}</td>
                            <td>
                                <div class="row justify-content-center">
                                    <a href="{{ route('schedules.show', $schedule) }}"
                                        class="mr-2 btn btn-link">Просмотр</a>
                                    <a href="{{ route('schedules.edit', $schedule) }}"
                                        class="mr-2 btn btn-primary">Редактировать</a>
                                    <a href="{{ route('couples.edit', $schedule) }}"
                                        class="mr-2 btn btn-info">Настройка</a>
                                    <form action="{{ route('schedules.destroy', $schedule) }}" method="POST">
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
                                <h1 class="text-center">Пока не составлено ни одного раписания</h1>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
