{{ csrf_field() }}
<div class="form-group">
	<label for="storeName" class="d-block text-center h5">Naziv</label>
	<input type="text" name="name" class="form-control" id="storeName" value="{{ $store->name or old('name') }}">
</div>
<div class="form-group">
	<button type="submit" class="btn btn-warning btn-block">{{ $submitButton }}</button>
</div>