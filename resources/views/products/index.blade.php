@extends('layouts.dashboard')

@section('content')

{{-- 	@if(!count($products))

		<div class="h1 text-center my-5">
			<h2>Nemate nijedan proizvod</h2>
			<a href="{{ route('stores.products.create', [$store->slug]) }}" class="btn btn-primary btn-lg mt-5">Dodajte proizvod</a>
		</div> --}}

	{{-- @else --}}

		{{-- <h2 class="text-center my-4">Proizvodi u prodavnici: "{{ $store->name }}"</h2> --}}
		{{-- <h3 class="text-center"><a href="{{ route('stores.products.create', [$store->slug]) }}" class="btn btn-primary btn-lg">Dodaj proizvod</a></h3> --}}

			@include('partials.products.ownerMany', compact('products'))

{{-- 	@endif --}}

@endsection