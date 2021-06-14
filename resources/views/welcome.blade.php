@extends('layouts.app')

@section('content')
    <entries-component :user="{{ json_encode(Auth::check() ? Auth::user() : '') }}" :csrf_token="{{ json_encode(csrf_token()) }}"
        :roles="{{ Auth::check() ? Auth::user()->roles->pluck('slug') : '[]' }}" :is_profile="{{ 0 }}"></entries-component>
@endsection