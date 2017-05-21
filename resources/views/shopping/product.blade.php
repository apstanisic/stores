@extends('layouts.shopping')

@section('content')
	{{-- {{ var_dump($product) }} --}}
	<div class="container-fluids px-1 px-md-4">
		<div class="row mt-4">
			<div class="col-12 col-md-4">
				<img src="{{ $product->images[0] or 'http://placehold.it/300x300' }}" alt="" class="img-fluid">
				{{-- {{ $product->images[0] or 'Nema slika' }} --}}
			</div>
			<div class="col-12 col-md-6">
				<div class="center flex-wrap">
					<h1>{{ $product->name }}</h1>
					<p class="h2 ml-auto">{{ $product->price }} din.</p>
				</div>
				<hr>
				<p class="mt-3">{{ $product->description }}</p>
			</div>
			<div class="col-12 col-md-2">
				<p class="h4 text-center">U korpu</p>
				<form action="{{ route('cart.store', [$store->user->slug, $store->slug, $product->slug]) }}" method="post">
					{{ csrf_field() }}
					<select name="amount" id="" class="custom-select form-control my-2">
						@for($i = 0; $i <= 10; $i++)
							<option value="{{ $i }}" {{ $i === $product->inCart() ? 'selected' : '' }}>{{ $i }}</option>
						@endfor
					</select>
					{{-- <p class="display-4">{{ $product->inCart() }}</p> --}}
					<button class="btn btn-primary btn-block">Dodaj</button>
				</form>
			</div>
		</div>
	</div>
@endsection