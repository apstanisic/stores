@if(!count($products))
	<p class="text-center my-5 display-4">Nema proizvoda</p>
@else

	<div class="d-inline-flex flex-wrap justify-content-center mx-auto">
		@foreach($products as $product)
			@component('partials.products.small')
				@slot('name')
					<a href="{{ route('shopping.products.show', [$product->store->user->slug, $product->store->slug, $product->slug]) }}">{{ $product->name }}</a>
				@endslot
				@slot('price')
					{{ $product->price }}
				@endslot
				@slot('remaining')
					{{ $product->remaining }}
				@endslot
				@slot('routes')
					<form action="{{ route('cart.store', [$product->store->user->slug, $product->store->slug, $product->slug]) }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="amount" value="+1">
						<button type="submit" class="btn btn-primary">U korpu</button>
					</form>
					<a href="{{ route('shopping.products.show', [$product->store->user->slug, $product->store->slug, $product->slug]) }}" class="btn btn-secondary">Detaljnije</a>
				@endslot
			@endcomponent
		@endforeach
	</div>
	@include('partials.pagination', ['items' => $products])

@endif

