@extends('layouts.shopping')
{{-- @extends('layouts.master') --}}

@section('content')
	<div class="container d-flex flex-wrap justify-content-center">
		@if(count($products))
			@foreach($products as $product)
				@component('partials.product')
					@slot('name')
						{{ $product->name }}
					@endslot
					@slot('price')
						{{ $product->price }}
					@endslot
					@slot('remaining')
						{{ $product->remaining }}
					@endslot
					@slot('links')
						<form action="{{ route('cart.store', [$user->id, $store->id, $product->id]) }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="amount" value="+1">
							<button type="submit" class="btn btn-primary">U korpu</button>
						</form>
						<a href="{{ route('shopping.product', [$user->id, $store->id, $product->id]) }}" class="btn btn-secondary">Detaljnije</a>
					@endslot
				@endcomponent
			@endforeach
		@endif
	</div>
@endsection