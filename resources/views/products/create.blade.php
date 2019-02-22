@extends('layouts.dashboard')


@section('content')
	@if(!count($categories))
		@component('partials.alert')
			@slot('type')
				danger
			@endslot

			@slot('message')
				Morate imati barem jednu kategoriju da biste dodali proizvod
			@endslot
		@endcomponent
	@endif
	<h2 class="text-center my-4">Dodaj proizvod</h2>
	<form action="{{ route('stores.products.store', [$store->slug]) }}" method="post">
		@include('products.form', ['submitButton' => 'Dodaj', 'method' => 'post'])
		<input type="hidden" id="enableEditingRemaining" checked>
	</form>

@endsection