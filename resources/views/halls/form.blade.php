<div class="form-inline mb-3">
    Название: <input type="text"
        class="form-control form-control-sm mx-2 mr-sm-2 @error('name') is-invalid @enderror" id="name"
        value="{{ old('name', $hall->name ?? '')}}" name="name" required>
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-inline mb-3">
    Этаж: <input type="number"
        class="form-control form-control-sm mx-2 mr-sm-2 @error('floor') is-invalid @enderror" id="floor"
        value="{{ old('floor', $hall->floor ?? '1')}}" name="floor" required min="1">
    @error('floor')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-inline mb-3">
    Количество дорожек: <input type="number"
        class="form-control form-control-sm mx-2 mr-sm-2 @error('lanes') is-invalid @enderror" id="lanes"
        value="{{ old('lanes', $hall->lanes ?? '1')}}" name="lanes" required min="1">
    @error('lanes')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-inline mb-3">
    Число мест на дорожку: <input type="number"
        class="form-control form-control-sm mx-2 mr-sm-2 @error('places') is-invalid @enderror" id="places"
        value="{{ old('places', $hall->places ?? '1')}}" name="places" required min="1">
    @error('places')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<button type="submit" class="btn btn-success">Сохранить</button>