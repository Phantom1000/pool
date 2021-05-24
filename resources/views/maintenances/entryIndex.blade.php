@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="row">
                <div class="alert alert-danger col-sm-8" role="alert">
                    Проверьте корректность введенных данных
                </div>
            </div>
        @endif
        <div class="row justify-content-between">
            <x-admin></x-admin>
            <div class="col-sm-5">
                <form class="form-inline" action="{{ route('maintenanceEntries.store') }}" method="POST">
                    @csrf
                    <select class="form-control form-control-sm mx-2 mr-sm-2 @error('maintenance_id') is-invalid @enderror"
                        name="maintenance_id">
                        @foreach ($maintenances as $maintenance)
                            <option value="{{ $maintenance->id }}">
                                {{ $maintenance->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('maintenance_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="date" class="form-control form-control-sm mx-2 mr-sm-2 @error('date') is-invalid @enderror"
                        name="date" value="{{ old('date') }}" required>
                    @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="time"
                        class="form-control form-control-sm mt-2 mx-2 mr-sm-2 @error('time') is-invalid @enderror"
                        name="time" value="{{ old('time') }}" required>
                    @error('time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <select
                        class="form-control form-control-sm mx-2 mt-2 mr-sm-2 @error('employee_id') is-invalid @enderror"
                        name="employee_id">
                        <option value="-1">
                            Любой
                        </option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->username }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="mt-3 btn btn-success">Добавить</button>
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
                        <th>Работа</th>
                        <th>Дата</th>
                        <th>Время</th>
                        <th>Сотрудник</th>
                        <th>Выполнено</th>
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($maintenanceEntries as $maintenanceEntry)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>
                                {{ $maintenanceEntry->maintenance->name }}
                            </td>
                            <td>
                                {{ $maintenanceEntry->date->format('d.m.Y') }}
                            </td>
                            <td>
                                {{ $maintenanceEntry->time->format('H:i') }}
                            </td>
                            <td>
                                @if ($maintenanceEntry->employee)
                                    <a href="{{ route('profiles.show', $maintenanceEntry->employee) }}"
                                        class="link">{{ $maintenanceEntry->employee->username }}</a>
                                @else
                                    Любой
                                @endif
                            </td>
                            <td>
                                {{ $maintenanceEntry->perform ? 'Да' : 'Нет' }}
                            </td>
                            <td>
                                <div class="row justify-content-center">
                                    <a href="{{ route('maintenanceEntries.edit', $maintenanceEntry) }}"
                                        class="mr-2 btn btn-primary">Редактировать</a>
                                    <form action="{{ route('maintenanceEntries.destroy', $maintenanceEntry) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="mr-2 btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <h1 class="text-center">Пока нет записей</h1>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $maintenanceEntries->links() }}
        </div>
    </div>
@endsection
