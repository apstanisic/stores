@extends('layouts.dashboard')


@section('content')
	@include('partials.errors')
	<form method="post" action="{{ route('stores.update', [$store->id]) }}">
		<input type="hidden" name="_method" value="patch">
		@include('stores.form', ['submitButton' => 'Promeni ime'])
	</form>


	<hr>
	<br>
	<hr>

	izmeni naziv

	dodaj proizvode
	dodaj kategorije
	izmeni izbrisi proizvode
	kategorije
@endsection