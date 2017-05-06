@extends('layouts.base')

@push('stylesheet')
	<link rel="stylesheet" href="{{ asset('css/sticky.css') }}">
@endpush

@section('body')
	@component('layouts.partials.header', compact('paramLinks'))
		@slot('right')

				<a href="{{ route('cart.index', [$user->id, $store->id]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Cart</a>
			 	@if($BAuth::check())
			 		<a href="{{ route('buyer.index', [$user->id, $store->id]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1">
			 			{{ $BAuth::buyer()->username }}
			 		</a>
					<form action="{{ route('buyer.logout', [$user->id, $store->id]) }}" method="post">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-outline-secondary my-3 my-md-0 mx-1">Logout</button>
					</form>
		 		@else
					<a href="{{ route('buyer.login', [$user->id, $store->id]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Login</a>
			      	<a href="{{ route('buyer.register', [$user->id, $store->id]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Sign Up</a>
		      	@endif

		@endslot
	@endcomponent

	<div class="content">
		@include('partials.flash')
		@yield('content')
	</div>

	@include('layouts.partials.footer')
@endsection

