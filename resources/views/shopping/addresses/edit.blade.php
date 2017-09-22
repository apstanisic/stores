@extends('layouts.shopping')

@section('content')
	<p class="h1 p-4 text-center">Izmeni adresu:</p>
	<div class="container pt-1">
		<form action="{{ route('shop.addresses.update', [$store->user->slug, $store->slug, $address->slug]) }}" method="post">
			{{ method_field('patch') }}
			@component('shopping.addresses.form', compact('address'))
				@slot('submitButton', 'Izmeni')
			@endcomponent
		</form>
	</div>

@endsection