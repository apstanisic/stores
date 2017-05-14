@extends('layouts.dashboard')

@section('content')
	<div class="container">
		<div class="card my-5">
		  	<div class="card-block card-inverse card-@include('partials.status_color')">
			    <h4 class="card-title text-center h2">Porudzbina {{ $order->id }}</h4>
			    <hr>
			    <p>{{ $order->status->description }}</p>
			    <div class="d-flex flex-wrap justify-content-between">
			    	<span class="h4">{{ $order->price }} din.</span>
			    	<span class="h4">{{ $order->created_at->diffForHumans() }}</span>
			    </div>
		  	</div>
		  	<div class="card-block">
		  		<form action="{{ route('stores.orders.updateStatus', [$store->id, $order->id]) }}" method="post">
		  			{{ csrf_field() }}
		  			<input type="hidden" name="_method" value="patch">
				  	<select name="status_id" class="form-control" id="changeStatus">
			  			@foreach(\App\Status::where('id', '!=', 7)->get() as $status)
							<option value="{{ $status->id }}" {{ ($status->id === $order->status->id) ? 'selected' : '' }}>{{ $status->description }}</option>
			  			@endforeach
			  		</select>
			  		<button type="submit" class="btn btn-primary btn-block mt-2">Izmeni status</button>
		  		</form>
		  	</div>
		  	<form action="{{ route('stores.orders.update', [$store->id, $order->id]) }}" method="post">
		  		{{ csrf_field() }}
		  		<input type="hidden" name="_method" value="patch">
			  	<ul class="list-group list-group-flush">
			  		{{-- Dodati jos proizvoda u porudzbinu --}}
			  		{{-- <li class="list-group-item bg-primary"><a href="#" class="text-white">Dodaj proizvod</a></li> --}}
			  		<li class="list-group-item text-muted">Proizvodi<span class="ml-auto">Kolicina</span></li>

			  		@foreach($order->products as $product)
						<li class="list-group-item h5">{{ $product->name }}<span class="ml-auto"><input type="number" name="{{ $product->id }}" min="0" max="100" class="form-control" value="{{ $product->pivot->amount }}"></span></li>
			  		@endforeach
			  	</ul>
			  	<div class="card-block">
		  			<button type="submit" class="btn btn-warning btn-block">Izmeni narudzbinu</button>
		  		</div>
	  		</form>
	  		<div class="card-block pt-0">
		  		<form action="{{ route('stores.orders.destroy', [$store->id, $order->id]) }}" method="post" class="text-right">
		  			{{ csrf_field() }}
		  			<input type="hidden" name="_method" value="delete">
		  			<button class="btn btn-danger">Izbrisi porudzbinu</button>
		  		</form>
	  		</div>
		</div>
	</div>
@endsection