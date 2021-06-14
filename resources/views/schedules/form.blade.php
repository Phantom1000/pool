<div class="form-inline mb-3">
    Действительно с <input type="date"
        class="form-control form-control-sm mx-2 mr-sm-2 @error('startdate') is-invalid @enderror" id="startdate"
        value="{{ old('startdate', $schedule->startdate ?? '') }}" name="startdate" required>
    @error('startdate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    по <input type="date" class="form-control form-control-sm mx-2 mr-sm-2 @error('enddate') is-invalid @enderror"
        id="enddate" value="{{ old('enddate', (isset($schedule) ? $schedule->enddate->format('Y-m-d') : '')) }}" name="enddate" required>
    @error('enddate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

</div>

<div class="form-inline mb-3">
    Время работы бассейна с <input type="time"
        class="form-control form-control-sm mx-2 mr-sm-2 @error('starttime') is-invalid @enderror" id="startdate"
        value="{{ old('starttime', (isset($schedule) ? $schedule->starttime->format('H:i') : '')) }}" name="starttime" required>
    @error('starttime')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    до <input type="time" class="form-control form-control-sm mx-2 mr-sm-2 @error('endtime') is-invalid @enderror"
        id="endtime" value="{{ old('endtime', (isset($schedule) ? $schedule->endtime->format('H:i') : '')) }}" name="endtime" required>
    @error('endtime')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-inline mb-3">
    Количество временных интервалов: <input type="number"
        class="form-control form-control-sm mx-2 mr-sm-2 @error('couples') is-invalid @enderror" id="couples"
        value="{{ old('couples', (isset($schedule) ? $schedule->couples->count() : '1')) }}" name="couples" required min="1">
    @error('couples')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-inline mb-3">
    Зал: <select class="form-control form-control-sm mx-2 mr-sm-2 @error('hall_id') is-invalid @enderror" id="hall_id"
        name="hall_id">
        <option disabled>Выберите</option>
        @foreach ($halls as $hall)
        <option value="{{ $hall->id ?? '' }}" @if (isset($schedule) && $hall->id === $schedule->hall_id) selected @endif>{{ $hall->name }}
        </option>
        @endforeach
    </select>
    @error('hall_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-inline mb-3">
    <label class="form-check-label" for="active">
        Сделать активным
    </label>
    <input type="checkbox" class="form-check-input mx-2 mr-sm-2 @error('active') is-invalid @enderror" id="active"
        name="active" @if (isset($schedule) && $schedule->active) checked @endif>
    @error('active')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<button type="submit" class="btn btn-success">Сохранить</button>