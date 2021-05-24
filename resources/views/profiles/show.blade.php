@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3 fio">
            <div class="row">
                {{ "$user->surname $user->name $user->patronymic" }}
            </div>
            <div class="row roles">
                Роли: {{ $roles }}
            </div>
        </div>
        <div class="col-sm-3">
            <a href="{{ route('profiles.edit', $user) }}" class="btn btn-info text-dark mtext">Изменить данные</a>
        </div>
        
    </div>

    <table class="table table-striped table-dark table-bordered mt-3">
        <thead>
            <tr>
                <th>Идентификатор</th>
                <th>Пользователь</th>
                <th>№ дорожки</th>
                <th>Мест</th>
                <th>Время</th>
                <th>Дата</th>
                <th>Состояние</th>
                <th class="text-center">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($entries as $entry)
            <tr>
                <td class="text-center" scope="row">
                    {{ $entry->uuid ?? '' }}
                </td>
                <td class="text-center" scope="row">
                    {{ $entry->user->username ?? '' }}
                </td>
                <td class="text-center" scope="row">
                    {{ $entry->lane ?? '' }}
                </td>
                <td class="text-center" scope="row">
                    {{ $entry->places ?? '' }}
                </td>
                <td class="text-center" scope="row">
                    {{ $entry->couple->start->format('H:i') }} -
                    {{ $entry->couple->end->format('H:i') }}
                </td>
                <td class="text-center" scope="row">
                    {{ $entry->date->format('d.m.Y') }}
                </td>
                <td class="text-center" scope="row">
                    @switch($entry->state)
                    @case(0)
                    Забронировано
                    @break
                    @case(1)
                    Куплено
                    @break
                    @case(2)
                    Посещается
                    @break
                    @default
                    Что-то не так
                    @endswitch
                </td>
                <td>
                    <div class="row justify-content-center">
                        @can('access', 'seller')
                        <form method="POST" action="{{ route('entries.pay', $entry) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success m-1">Подтвердить оплату</button>
                        </form>
                        @endcan
                        @can('access', 'controller')
                        <form method="POST" action="{{ route('entries.pass', $entry) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success m-1">Пропустить</button>
                        </form>
                        @endcan
                        @if ($entry->state === 0)
                            <form method="POST" action="{{ route('entries.destroy', $entry) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger m-1">Отменить</button>
                            </form>
                        @endif
                        
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <h1 class="text-center">Нет записей</h1>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $entries->withQueryString()->links() }}

</div>
@endsection