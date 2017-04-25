@extends('layouts.dashboard')


@section('content')

	<h2 class="text-center my-4">Izmeni proizvod</h2>
	<form action="{{ route('stores.products.update', [$store->id, $product->id]) }}" method="post">
		<input type="hidden" name="_method" value="patch">
		@include('products.form', ['submitButton' => 'Izmeni'])
	</form>

@endsection