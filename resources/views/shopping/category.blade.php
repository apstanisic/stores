@extends('layouts.shopping')

@section('content')
	<div class="container">
		<div class="d-inline-flex flex-wrap justify-content-center mx-auto">
			@include('partials.products', compact('products'))
		</div>
	</div>
@endsection