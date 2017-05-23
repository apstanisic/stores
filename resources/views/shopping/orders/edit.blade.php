@extends('layouts.shopping')

@section('content')
	<div class="container">
		<div class="card my-5">
		  	<div class="card-block card-inverse card-@include('partials.status_color', ['status' => $order->status->name])">
			    <h4 class="card-title text-center h2">Porudzbina {{ $order->slug }}</h4>
			    <hr>
			    <p>{{ $order->status->description }}</p>
			    <div class="d-flex flex-wrap justify-content-between">
			    	<span class="h4">{{ $order->price }} din.</span>
			    	<span class="h4">{{ $order->created_at->diffForHumans() }}</span>
			    </div>
		  	</div>
		  	<form action="{{ route('buyer.orders.update', [$order->store->user->slug, $order->store->slug, $order->slug]) }}" method="post">
		  		{{ csrf_field() }}
		  		{{ method_field('patch') }}
			  	<ul class="list-group list-group-flush">
			  		{{-- Dodati jos proizvoda u porudzbinu --}}
			  		{{-- <li class="list-group-item bg-primary"><a href="#" class="text-white">Dodaj proizvod</a></li> --}}
			  		<li class="list-group-item text-muted">Proizvodi<span class="ml-auto">Kolicina</span></li>

			  		@foreach($order->products as $product)
						<li class="list-group-item h5">{{ $product->name }}<span class="ml-auto"><input type="number" name="{{ $product->slug }}" min="0" max="100" class="form-control" value="{{ $product->pivot->amount }}"></span></li>
			  		@endforeach
			  	</ul>
			  	<div class="card-block">
		  			<button type="submit" class="btn btn-warning btn-block mx-2">Izmeni</button>
		  		</div>
	  		</form>
		</div>
	</div>
@endsection