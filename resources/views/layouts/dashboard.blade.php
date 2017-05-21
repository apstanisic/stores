@extends('layouts.base')


@section('body')
	<div class="d-flex">

		@include('layouts.partials.sidebar', compact('store'))

		<div class="content container min-250 overflow-hidden">
			@include('partials.flash')
			@yield('content')
		</div>
	</div>

@endsection