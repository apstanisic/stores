@extends('layouts.shopping')
{{-- @extends('layouts.master') --}}

@section('content')
	<div class="container">
		<div class="d-inline-flex flex-wrap justify-content-center mx-auto">
			@include('partials.products', compact('product'))
		</div>
	</div>
@endsection