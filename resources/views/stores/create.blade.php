@extends('layouts.master')

@section('content')

	{{-- @include('partials.errors') --}}
	<div class="container">
		<h1 class="text-center mt-5 mb-3">Napravi novu prodavnicu</h1>
		<form method="post" action="{{ route('stores.store') }}" class="my-5 max-750 mx-auto">
			@include('stores.form', ['submitButton' => 'Napravi'])
		</form>
	</div>
@endsection