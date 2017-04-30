@extends('layouts.base')

@section('body')
	@component('layouts.partials.header', compact('paramLinks'))
		@slot('right')

				<a href="{{ route('root') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Cart</a>
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


	@yield('content')


@endsection

