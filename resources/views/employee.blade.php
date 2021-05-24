@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-sm-6 titles">{{ $title }}</div>
        @if(Auth::check())
        @can('access', 'staff')
        <table class="table table-striped table-dark table-bordered mt-3">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Работа</th>
                    <th>Дата</th>
                    <th>Время</th>
                    <th>Сотрудник</th>
                    <th class="text-center">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($entries as $entry)
                <tr>
                    <td class="text-center" scope="row">
                        {{ $loop->index + 1 }}
                    </td>
                    <td class="text-center" scope="row">
                        {{ $entry->maintenance->name ?? '' }}
                    </td>
                    <td class="text-center" scope="row">
                        {{ $entry->date->format('d.m.Y') ?? '' }}
                    </td>
                    <td class="text-center" scope="row">
                        {{ $entry->time->format('H:i') ?? '' }}
                    </td>
                    <td class="text-center" scope="row">
                        {{ $entry->employee->username ?? 'Любой' }}
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <form method="POST" action="{{ route('maintenanceEntries.confirm', $entry) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success m-1">Выполнено</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <h1 class="text-center">Записей для обработки нет</h1>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $entries->links() }}
    @endcan
    @endif
</div>
</div>
@endsection