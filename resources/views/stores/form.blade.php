{{ csrf_field() }}
<div class="form-group">
	<label for="storeName" class="d-block text-center h5">Naziv</label>
	<input type="text" name="name" class="form-control" id="storeName" value="{{ $store->name or old('name') }}"  required>
</div>

<div class="form-group">
	<label for="storeDescription" class="d-block text-center h5">Opis</label>
	<textarea name="description" class="form-control" id="storeDescription" rows="10">{{ $store->description or old('description') }}</textarea>
</div>

<div class="form-group">
	<button type="submit" class="btn btn-warning btn-block">{{ $submitButton }}</button>
</div>