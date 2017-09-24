@extends('layouts.base')


@push('stylesheet')
	<link rel="stylesheet" href="{{ asset('css/sticky.css') }}">
@endpush

@section('body')

	@component('layouts.partials.header', compact('links'))
		@slot('right')

		 	@if (Auth::check())
		 		{{-- <div class="d-flex"> --}}
			 		<a href="{{ route('user.index') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1">{{ auth()->user()->username }}</a>
					<form action="{{ route('logout') }}" method="post">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-outline-secondary my-3 my-md-0 mx-1">Izloguj se</button>
					</form>
				{{-- </div> --}}
	 		@else
				<a href="{{ route('login') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Uloguj se</a>
		      	<a href="{{ route('register') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Registruj se</a>
	      	@endif

		@endslot
	@endcomponent

	<div class="content">
		<div class="container">
			@include('partials.flash')
		</div>
		@yield('content')
	</div>

	@include('layouts.partials.footer')

@endsection
