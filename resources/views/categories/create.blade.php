@extends('layouts.dashboard')

@section('content')

	<div class="container">
		<h1 class="text-center mt-5 mb-3">Dodaj novu kategoriju</h1>
		<form action="{{ route('stores.categories.store', [$store->slug]) }}" method="post" class="my-5 max-750 mx-auto">
			@include('categories.form', ['submitButton' => 'Napravi'])
		</form>
	</div>

@endsection