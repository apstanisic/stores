@extends('layouts.dashboard')


@section('content')

	<h2 class="text-center my-4">Izmeni proizvod</h2>

	@if($product->remaining !== null)
		@include('products.form_remaining')
		<hr>
	@endif


	<form action="{{ route('stores.products.update', [$product->store->slug, $product->slug]) }}" method="post" class="border-1 p-1 p-md-3">
		{{ method_field('patch') }}
		@include('products.form', ['submitButton' => 'Izmeni'])
	</form>

@endsection