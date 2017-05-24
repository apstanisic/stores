@if(!count($products))
	<p class="text-center my-5 display-4">Nema proizvoda</p>
@else

	{{-- <div class="d-inline-flex flex-wrap justify-content-center mx-auto"> --}}
	<div class="row no-gutters">
		@foreach($products as $product)
			<div class="col-12 col-sm-6 col-md-4 col-lg-4">
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
					<form action="{{ route('cart.store', [$product->store->user->slug, $product->store->slug, $product->slug]) }}" method="post" class="w-100">
						{{ csrf_field() }}
						<input type="hidden" name="amount" value="+1">
						<button type="submit" class="btn btn-primary btn-block"  {{ ($product->remaining > 0) ? '' : 'disabled'}}>U korpu</button>
					</form>
					{{-- <a href="{{ route('shopping.products.show', [$product->store->user->slug, $product->store->slug, $product->slug]) }}" class="btn btn-info"><i class="fa fa-info-circle" aria-hidden="true"></i></a> --}}
				@endslot
			@endcomponent
			</div>
		@endforeach
	</div>
	@include('partials.pagination', ['items' => $products])

@endif

