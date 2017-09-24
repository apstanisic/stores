{{ csrf_field() }}
<div class="form-group">
	<label for="categoryName" class="d-block text-center h5">Naziv</label>
	<input type="text" name="name" class="form-control" id="categoryName" value="{{ $category->name or old('name') }}" required>
</div>
<div class="form-group">
	<label for="categoryParent" class="d-block text-center h5">Nadkategorija</label>
	<select name="parent_id" id="categoryParent" class="form-control">
			<option value="">Nijedna</option>
		@foreach($parents as $parentCategory)
			@if(isset($category) && $category->id === $parentCategory->id)
			{{-- There should be an option to category be parent to  itself  --}}
			@elseif(($parentCategory->id === (isset($category->parent_id) ? $category->parent_id : null)) || ($parentCategory->id === old('parent_id')))
				<option value="{{ $parentCategory->id }}" selected>{{ $parentCategory->name }}</option>
			@else
				<option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
			@endif
		@endforeach
	</select>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-warning btn-block">{{ $submitButton }}</button>
</div>