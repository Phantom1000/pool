<div class="col-sm-8">
    <form action="{{ $action }}" method="GET">
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#lanes"
                    aria-expanded="false" aria-controls="lanes">
                    Номер дорожки
                </button>
                <div class="ml-2 collapse mt-2" id="lanes">
                    @for ($i = 1; $i <= 9; $i++)
                        <div class="form-check">
                            <div class="row">
                                <input class="form-check-input" type="checkbox" name="lanes[]" value="{{ $i }}"
                                    id="{{ 'lane' . $i }}" @if (in_array($i, $lanes)) checked @endif>
                                <label class="form-check-label text" for="{{ 'lane' . $i }}">
                                    {{ $i }}
                                </label>
                            </div>
                        </div>
                        @endfor
                </div>
            </div>
            <div class="col-sm-4">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#time"
                    aria-expanded="false" aria-controls="time">
                    Время
                </button>
                <div class="ml-2 collapse mt-2" id="time">
                    @foreach($schedule->couples as $couple)
                    <div class="form-check">
                        <div class="row">
                            <input class="form-check-input" type="checkbox" name="time[]" value="{{ $couple->id }}"
                                id="{{ 'couple' . $couple->id }}" @if (in_array($couple->id, $couples)) checked @endif>
                            <label class="form-check-label text" for="{{ 'couple' . $couple->id }}">
                                {{ $couple->start->format('H:i') }} -
                                {{ $couple->end->format('H:i') }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-4 text">
                Дата: <input class="form-control" type="date" name="date" value="{{ $date }}" id="date">
            </div>
        </div>

        <button class="btn btn-success ml-2 mt-2" type="submit">
            Применить
        </button>
    </form>
</div>