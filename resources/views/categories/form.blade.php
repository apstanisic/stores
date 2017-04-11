{{ csrf_field() }}
<div class="form-group">
	<label for="categoryName" class="d-block text-center h5">Naziv</label>
	<input type="text" name="name" class="form-control" id="categoryName" value="{{ $category->name or old('name') }}" required>
</div>
<div class="form-group">
	<label for="categoryParent" class="d-block text-center h5">Nadkategorija</label>
	<select name="parent_id" id="categoryParent" class="form-control">
			<option value="">Nijedna</option>
		@foreach($parents as $parent)
			@if($parent->id === (isset($category->parent_id) ? $category->parent_id : null) || $parent->id === old('parent'))
				<option value="{{ $parent->id }}" selected>{{ $parent->name }}</option>
			@else
				<option value="{{ $parent->id }}">{{ $parent->name }}</option>
			@endif
		@endforeach
	</select>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-warning btn-block">{{ $submitButton }}</button>
</div>