@extends('layouts.base')

@push('stylesheet')
	<link rel="stylesheet" href="{{ asset('css/sticky.css') }}">
@endpush

@section('body')
	@component('layouts.partials.header', compact('paramLinks'))
		@slot('right')

				<a href="{{ route('cart.index', [$user->id, $store->id]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Cart</a>
			 	@if (Auth::check())
				 		<a href="{{ route('user.index') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1">{{ auth()->user()->username }}</a>
						<form action="{{ route('logout') }}" method="post">
							{{ csrf_field() }}
							<button type="submit" class="btn btn-outline-secondary my-3 my-md-0 mx-1">Logout</button>
						</form>
		 		@else
					<a href="{{ route('login') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Login</a>
			      	<a href="{{ route('register') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Sign Up</a>
		      	@endif

		@endslot
	@endcomponent

	<div class="content">
		@include('partials.flash')
		@yield('content')
	</div>

	@include('layouts.partials.footer')
@endsection
