<div class="form-inline mb-3">
    Название: <input type="text"
        class="form-control form-control-sm mx-2 mr-sm-2 @error('name') is-invalid @enderror" id="name"
        value="{{ old('name', $maintenance->name ?? '')}}" name="name" required>
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<button type="submit" class="btn btn-success">Сохранить</button>