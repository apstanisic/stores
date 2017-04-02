@extends('layouts.base')




@section('body')
	@include('partials.header')

	@yield('before')

	<div class="container">
		{{-- @require('loader') --}}
		@yield('content')
	</div>

	@yield('after')

	@include('partials.footer')
	
@endsection