@extends('layouts.shopping')

@section('content')
	<div class="container">
		<div class="d-inline-flex flex-wrap justify-content-center mx-auto">
			@include('partials.products.buyerMany', compact('products'))
		</div>
	</div>
@endsection