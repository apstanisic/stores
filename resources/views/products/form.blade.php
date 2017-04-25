{{ csrf_field() }}

<div class="form-group">
	<label for="productName" class="d-block text-center h5">Naziv</label>
	<input type="text" name="name" class="form-control" id="productName" value="{{ $product->name or old('name') }}" required>
</div>

<div class="form-group">
	<label for="productDescription" class="d-block text-center h5">Opis</label>
	<textarea class="form-control" name="description" id="productDescription" rows="10" required>{{ $product->description or old('description') }}</textarea>
</div>

<div class="form-group">
	<label for="productPrice" class="d-block text-center h5">Cena u dinarima</label>
	<input type="number" name="price" class="form-control" id="productPrice" min="0" value="{{ $product->price or old('name') }}" required>
</div>

@if ($method ?? false)
	<div class="form-group">
		<label for="productRemaining" class="d-block text-center h5">Preostalo</label>
		<input type="number" name="remaining" class="form-control" id="productRemaining" min="0" value="{{ $product->remaining or old('remaining') }}" required>
	</div>
@else
	<div class="form-group">
		<label for="changeProductRemaining" class="d-block text-center h5">Izmeni kolicinu proizvoda na stanju</label>
		<input type="number" name="change_remaining" class="form-control" id="changeProductRemaining" value="{{ old('remaining') }}">
	</div>
@endif

<div class="form-group">
	<label for="productCategory" class="d-block text-center h5">Kategorija</label>
	<select name="category_id" id="productCategory" class="form-control">
			<option value="0">Izaberite...</option>
		@foreach($categories as $category)
			@if($category->id === (isset($product->category_id) ? $product->category_id : null) || $category->id === old('category'))
				<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
			@else
				<option value="{{ $category->id }}">{{ $category->name }}</option>
			@endif
		@endforeach
	</select>
</div>

<div class="form-group">
	<button type="submit" class="btn btn-warning btn-block">{{ $submitButton }}</button>
</div>