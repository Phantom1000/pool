<div class="form-inline mb-3">
    <select class="form-control form-control-sm mx-2 mr-sm-2 @error('maintenance_id') is-invalid @enderror"
        name="maintenance_id">
        @foreach ($maintenances as $maintenance)
            <option value="{{ $maintenance->id }}" @if ($maintenance->id == $maintenanceEntry->maintenance_id) selected @endif>
                {{ $maintenance->name }}
            </option>
        @endforeach
    </select>
    @error('maintenance_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-inline mb-3">
    <input type="date" class="form-control form-control-sm mx-2 mr-sm-2 @error('date') is-invalid @enderror" name="date"
        value="{{ $maintenanceEntry->date->format('Y-m-d') }}" required>
    @error('date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-inline mb-3">
    <input type="time" class="form-control form-control-sm mx-2 mr-sm-2 @error('time') is-invalid @enderror" name="time"
        value="{{ $maintenanceEntry->time->format('H:i') }}" required>
    @error('time')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-inline mb-3">
    <select class="form-control form-control-sm mx-2 mr-sm-2 @error('employee_id') is-invalid @enderror" name="employee_id">
        <option value="-1">
            Любой
        </option>
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}" @if ($employee->id == $maintenanceEntry->employee_id) selected @endif>
                {{ $employee->username }}
            </option>
        @endforeach
    </select>
    @error('employee_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-inline mb-3">
    <label class="form-check-label" for="perform">
        Выполнено
    </label>
    <input type="checkbox" class="form-check-input mx-2 mr-sm-2 @error('perform') is-invalid @enderror" id="perform"
        name="perform" @if (isset($maintenanceEntry) && $maintenanceEntry->perform) checked @endif>
    @error('perform')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<button type="submit" class="ml-1 btn btn-success">Сохранить</button>
