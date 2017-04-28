@if ($errors->any())
	<div class="container">
		<div class="alert alert-danger mt-2 text-center">
			@foreach ($errors->all() as $error)
				<p class="mb-0">{{ $error }}</p>
			@endforeach
		</div>
	</div>
@endif