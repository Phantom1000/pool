@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <x-admin></x-admin>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <table class="table table-striped table-dark table-bordered mt-3 col-sm-9">
                <thead>
                    <tr>
                        <th>Имя пользователя</th>
                        <th>Email</th>
                        <th>Роли</th>
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-center" scope="row">
                                {{ $user->username ?? '' }}
                            </td>
                            <td class="text-center" scope="row">
                                {{ $user->email ?? '' }}
                            </td>
                            <td class="text-center" scope="row">
                                @foreach ($user->roles as $role)
                                    <div class="row m-1">
                                        {{ $role->name ?? '' }}
                                        <form action="{{ route('roles.destroy', [$user, $role]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="ml-2 btn btn-sm btn-danger" type="submit">Удалить</button>
                                        </form>
                                    </div>
                                @endforeach
                                <form action="{{ route('roles.store', $user) }}" method="POST">
                                    @csrf
                                    <div class="row mt-2">
                                        <div class="col-sm-4">
                                            <select class="form-control form-control-sm mb-2 mx-2 mr-sm-2" name="role"
                                                id="role">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="ml-2 btn btn-sm btn-success" type="submit">Добавить</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <div class="row justify-content-center">
                                    <a href="{{ route('profiles.show', $user) }}" class="mr-2 btn btn-link">Перейти</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <h1 class="text-center">Записей для обработки нет</h1>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection
