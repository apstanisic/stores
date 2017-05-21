@extends('layouts.dashboard')

@section('content')
	<h1 class="text-center mt-5 mb-3">Izmeni prodavnicu</h1>
	<form method="post" action="{{ route('stores.update', [$store->slug]) }}" class="my-5 max-750 mx-auto">
		{{ method_field('patch') }}
		@include('stores.form', ['submitButton' => 'Izmeni'])
	</form>
@endsection