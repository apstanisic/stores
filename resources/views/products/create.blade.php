@extends('layouts.dashboard')


@section('content')

	<h2 class="text-center my-4">Dodaj proizvod</h2>
	<form action="{{ route('stores.products.store', [$store->id]) }}" method="post">
		@include('products.form', ['submitButton' => 'Dodaj', 'method' => 'post'])
	</form>

@endsection