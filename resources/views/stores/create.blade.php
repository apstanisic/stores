@extends('layouts.master')

@section('content')

	@include('partials.errors')

	<form method="post" action="{{ route('stores.store') }}">
		@include('stores.form', ['submitButton' => 'Napravi'])
	</form>
@endsection