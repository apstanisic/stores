@extends('layouts.shopping')

@section('content')
	<p class="h1 p-4 text-center">Dodaj adresu:</p>
	<div class="container pt-1">
		<form action="{{ route('shop.addresses.store', [$store->user->slug, $store->slug]) }}" method="post">
			@component('shopping.addresses.form')
				@slot('submitButton', 'Dodaj')
			@endcomponent
		</form>
	</div>

@endsection