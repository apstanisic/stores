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
	<label for="storeCurrency" class="d-block text-center h5">Valuta{{-- (Ovo polje trenutno nicemu ne sluzi) --}}</label>
	<select name="currency" id="storeCurrency" class="form-control">
		<option value="">din</option>
		<option value="">euro</option>
		<option value="">dolar</option>
		<option value="">funta</option>
	</select>
</div>

<div class="form-group">
	<button type="submit" class="btn btn-warning btn-block">{{ $submitButton }}</button>
</div>