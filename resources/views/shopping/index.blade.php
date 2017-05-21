@extends('layouts.shopping')

@section('content')
	<div class="container">

		@include('partials.products.buyerMany', compact('product'))

	</div>
@endsection