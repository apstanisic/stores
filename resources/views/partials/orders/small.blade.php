<div class="card m-3">
	<div class="card-header bg-@include('partials.status_color', compact('status')) text-white d-flex justify-content-between flex-wrap">
		<span class="h3 mb-0">{{ $id }}</span>
		<span class="h3 mb-0">{{ $price }} dinara</span>
		<span>{{ $created_at }}</span>
	</div>
	<div class="card-block">
		{{-- You can pass counter if you wants --}}
		<p class="card-title">{{ (isset($counter)) ? $counter . '. ' : '' }}{{ $description }} </p>
		<p>Sadrži {{ $amount }} proizvod/a.</p>
		<div class="m-2">
			{{ $routes }}
		</div>

	</div>
</div>