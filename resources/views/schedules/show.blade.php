@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-sm-7 titles">
            <div class="row">Просмотр расписания на
                {{ DateTime::createFromFormat('Y-m-d', $date)->format('d.m.Y') ?? '' }}
            </div>
            <div class="row">Расписание составлено с
                {{ DateTime::createFromFormat('Y-m-d', $schedule->startdate)->format('d.m.Y') ?? '' }} по
                {{ $schedule->enddate->format('d.m.Y') ?? '' }}
            </div>
        </div>
        <div class="col-sm-5">
            <form @if($isAdmin) action="{{ route('schedules.show', $schedule) }}" @else action="{{ route('schedules.active', $hall) }}" @endif method="GET" 
                class="form-inline">
                @if (!$isAdmin)
                    <label for="hall_id" class="text">Зал:</label>
                    <select class="form-control form-control-sm mx-2 mr-sm-2 @error('hall_id') is-invalid @enderror" id="hall_id" name="hall_id">
                        <option disabled>Выберите</option>
                        @foreach ($halls as $item)
                        <option value="{{ $item->id ?? '' }}" @if ($item->id === $hall->id) selected @endif>{{ $item->name }}
                        </option>
                        @endforeach
                    </select>
                @endif
                <input type="date"
                    class="form-control form-control-sm mb-2 mx-2 mr-sm-2 @error('date') is-invalid @enderror" id="date"
                    value="{{ $date ?? '' }}" name="date" required>
                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message ?? '' }}</strong>
                </span>
                @enderror
                <button type="submit" class="btn btn-primary">Выбрать</button>
            </form>
        </div>
    </div>
    <table class="table table-striped table-dark table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-center">Время/№ дорожки</th>
                @for ($i = 1; $i <= $hall->lanes; $i++)
                    <th class="text-center">{{ $i }}</th>
                    @endfor
            </tr>
        </thead>
        <tbody>
            @if (strtotime($date) >= strtotime($schedule->startdate) && strtotime($date) <= strtotime($schedule->
                enddate))
                @forelse ($couples as $couple)
                <tr>
                    <td class="text-center" scope="row">
                        {{ $couple->start->format('H:i') ?? '' }} - {{ $couple->end->format('H:i') ?? '' }}
                    </td>
                    @for ($i = 1; $i <= $hall->lanes; $i++)
                        <td @if($service->check($i, $date, $couple, 1, $hall)) class="bg-success text-dark text-right"
                            @else class="bg-danger text-dark text-right" @endif>
                            {{ $service->calculate($i, $date, $couple, $hall) }}
                        </td>
                        @endfor
                </tr>
                @empty
                <tr>
                    <td colspan="{{ $hall->lanes + 1 }}">
                        <h1 class="text-center">Нету доступного времени</h1>
                    </td>
                </tr>
                @endforelse
                @else
                <tr>
                    <td colspan="{{ $hall->lanes + 1 }}">
                        <h1 class="text-center">Расписание не составлено на эту дату</h1>
                    </td>
                </tr>
                @endif

        </tbody>
    </table>
    @if (!$isAdmin)
    <div id="app">
        <form action="{{ route('entries.book') }}" method="POST">
            @csrf
            @method('PUT')
            @if (session('error'))
            <div class="alert alert-danger col-sm-8" role="alert">
                Проверьте корректность введенных данных
            </div>
            @endif
            <input type="hidden" name="select" value="{{ $date }}">
            <input type="hidden" name="hall" value="{{ $hall->id }}">
            <check-component :user="{{ Auth::user()->id ?? 0 }}" :couples=@json($format_couples)
                :lanes="{{ $hall->lanes }}" :hall="{{ $hall->id }}" :route="{{ json_encode(route('entries.check')) }}"></check-component>
        </form>
    </div>
    @endif

</div>
@endsection