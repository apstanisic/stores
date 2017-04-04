{{ csrf_field() }}
<label for="storeName">Naziv prodavnice
	<input type="text" name="name" class="form-control" id="storeName" value="{{ $store->name or old('name') }}">
</label>
<button type="submit" class="btn btn-warning">{{ $submitButton }}</button>