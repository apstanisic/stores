@extends('layouts.base')


@section('body')
@include('partials.flash')
<div class="max-500 mx-auto mt-5">
	<a href="{{ route('shopping.index', [$user->id, $store->id]) }}">
		<div class="my-3 text-center">
			<img src="{{ asset('img/logo.png') }}" alt="logo" height="100px" width="100px">
		</div>
	</a>

	<h1 class="text-muted text-center text-thin">Ulogujte se i {{ $store->name }}</h1>

	@include('buyer.forms.login')

	<div class="mx-auto p-3 d-flex align-items-center justify-content-center my-4 rounded border-grey">
		<p class="mb-0">Nemate nalog? <a href="{{ route('buyer.register', [$store->id, $user->id]) }}">Registrujte se.</a></p>
	</div>

</div>
@endsection