

	@if(!count($products))
		<div class="d-flex flex-column align-items-center justify-content-center">
			<p class="display-4 my-5">Nema proizvoda</p>
			<a href="{{ route('stores.products.create', [$store->slug]) }}" class="btn btn-primary btn-lg mt-5">Dodajte proizvod</a>
		</div>
	@else
		<h2 class="text-center my-4">Proizvodi u prodavnici: "{{ $products->first()->store->name }}"</h2>
		<h3 class="text-center"><a href="{{ route('stores.products.create', [$products->first()->store->slug]) }}" class="btn btn-primary btn-lg">Dodaj proizvod</a></h3>
	{{-- <div class="container"> --}}

		<div class="row no-gutters">
			@foreach($products as $product)
				<div class="col-12 col-sm-6 col-md-4 col-lg-4">
					@component('partials.products.small')
						@slot('name')
							<a href="{{ route('stores.products.show', [$product->store->slug, $product->slug]) }}">{{ $product->name }}</a>
						@endslot
						@slot('price')
							{{ $product->price }}
						@endslot
						@slot('remaining')
							{{ $product->remaining }}
						@endslot
						@slot('routes')
							<a href="{{ route('stores.products.edit', [$product->store->slug, $product->slug]) }}" class="btn btn-primary">Izmeni</a>
							<form action="{{ route('stores.products.destroy', [$product->store->slug, $product->slug]) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('delete') }}
								<button type="submit" class="btn btn-danger">Izbriši</button>
							</form>
						@endslot
					@endcomponent
				</div>
			@endforeach

	{{-- </div> --}}

	@include('partials.pagination', ['items' => $products])

	@endif

