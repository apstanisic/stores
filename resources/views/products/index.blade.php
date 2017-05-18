@extends('layouts.dashboard')

@section('content')

	@if(!count($products))
		<div class="h1 text-center my-5">
			<h2>Nemate nijedan proizvod</h2>
			<a href="{{ route('stores.products.create', [$store->id]) }}" class="btn btn-primary btn-lg mt-5">Dodajte proizvod</a>
		</div>
	@else

		<h2 class="text-center my-4">Proizvodi u prodavnici: "{{ $store->name }}"</h2>
		<h3 class="text-center"><a href="{{ route('stores.products.create', [$store->id]) }}" class="btn btn-primary btn-lg">Dodaj proizvod</a></h3>
		<div class="d-flex flex-wrap justify-content-center">

			@foreach($products as $product)

				@component('partials.product')
					@slot('name')
						<a href="{{ route('stores.products.show', [$store->id, $product->id]) }}">{{ $product->name }}</a>
					@endslot
					@slot('price')
						{{ $product->price }}
					@endslot
					@slot('remaining')
						{{ $product->remaining}}
					@endslot
					@slot('links')
						<a href="{{ route('stores.products.edit', [$store->id, $product->id]) }}" class="btn btn-primary">Izmeni</a>
						<form action="{{ route('stores.products.destroy', [$store->id, $product->id]) }}" method="post">
							{{ csrf_field() }}
							{{ method_field('delete') }}
							{{-- <input type="hidden" name="_method" value="delete"> --}}
							<button type="submit" class="btn btn-danger">Izbrisi</button>
						</form>
					@endslot
				@endcomponent

			@endforeach

		</div>
	@endif

@endsection