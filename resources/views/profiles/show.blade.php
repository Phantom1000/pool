@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-3 fio">
                <div class="row">
                    {{ "$user->surname $user->name $user->patronymic" }}
                </div>
                <div class="row roles">
                    Роли: {{ $roles }}
                </div>
            </div>
            <div class="col-sm-3">
                @can('update', $user)
                    <div class="row">
                        <a href="{{ route('profiles.edit', $user) }}" class="btn btn-info text-dark mtext">Изменить данные</a>
                    </div>
                    <div class="row mt-3">
                        <a href="{{ route('password.update', $user) }}" class="btn btn-info text-dark mtext">Изменить
                            пароль</a>
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <entries-component :user="{{ json_encode(Auth::check() ? Auth::user() : '') }}" :csrf_token="{{ json_encode(csrf_token()) }}"
        :roles="{{ Auth::check() ? Auth::user()->roles->pluck('slug') : '[]' }}" :is_profile="{{ 1 }}"></entries-component>
@endsection
