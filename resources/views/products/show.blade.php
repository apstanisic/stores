@extends('layouts.dashboard')


@section('content')
{{-- <p class="display-4 text-center">{{ $product->name }}</p>
<p class="display-4 text-center">{{ $product->description }}</p>
<p class="display-4 text-center">{{ $product->price }} din</p>
<p class="display-4 text-center">{{ $product->remaining }}</p>
<p class="display-4 text-center">{{ $product->category->name }}</p>
<p class="display-4 text-center">{{ $product->store->name }}</p>
 --}}
<p class="display-4 mt-4 text-center">{{ $product->name }}</p>
<p class="text-center"><a href="{{ route('stores.products.edit', [$product->store->slug, $product->slug]) }}" class="btn btn-warning btn-lg">Izmeni</a></p>

<div class="container mt-4">
<div class="row">
<div class="col-12 col-md-4">
	<img src="{{ $product->images[0] or 'http://placehold.it/300x300' }}" alt="" class="img-fluid">
		{{-- {{ $product->images[0] or 'Nema slika' }} --}}
</div>
<div class="col-12 col-md-8">
	<div class="center flex-wrap">
		<p class="h2">{{ $product->store->name }}</p>
		<p class="h2 ml-auto">{{ $product->price }} din.</p>
	</div>
	<div class="center flex-wrap">
		<p class="h4">{{ (isset($product->category->parent->name)) ? $product->category->parent->name . ' - ' : '' }}{{ $product->category->name }}</p>
		<p class="h4 ml-auto">Preostalo: {{ $product->remaining }}</p>

	</div>
	<hr>
	<p class="mt-3">{{ $product->description }}</p>
</div>
</div>
</div>

@endsection