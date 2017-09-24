{{ csrf_field() }}
<div class="form-group">
	<label for="addressName" class="d-block text-center h5">Naziv</label>
	<input type="text" name="name" class="form-control" id="addressName" value="{{ $address->name or old('name') }}" required>
</div>
<div class="form-group">
	<label for="addressStreet" class="d-block text-center h5">Ulica</label>
	<input type="text" name="street_name" class="form-control" id="addressStreet" value="{{ $address->street_name or old('street_name') }}" required>
</div>
<div class="form-group">
	<label for="addressNumber" class="d-block text-center h5">Broj</label>
	<input type="text" name="building_number" class="form-control" id="addressNumber" value="{{ $address->building_number or old('building_number') }}" required>
</div>
<div class="form-group">
	<label for="addressPostal" class="d-block text-center h5">Poštanski broj</label>
	<input type="text" name="postal_code" class="form-control" id="addressPostal" value="{{ $address->postal_code or old('postal_code') }}" required>
</div>
<div class="form-group">
	<label for="addressCity" class="d-block text-center h5">Grad</label>
	<input type="text" name="city" class="form-control" id="addressCity" value="{{ $address->city or old('city') }}" required>
</div>

<div class="form-group">
	<button type="submit" class="btn btn-warning btn-block">{{ $submitButton }}</button>
</div>