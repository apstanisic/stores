@include('partials.errors')
<form method="post" action="{{ url('/stores') }}">
	{{ csrf_field() }}
	<label for="storeName">Naziv prodavnice
		<input type="text" name="name" class="form-control" id="storeName" value="{{ old('name') }}">
	</label>
	<button type="submit" class="btn btn-warning">Napravi prodavnicu</button>
</form>