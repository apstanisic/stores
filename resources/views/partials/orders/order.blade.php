<div class="container">
		<div class="card my-5">
		  	<div class="card-block card-inverse card-@include('partials.status_color')">
			    <h4 class="card-title text-center h2">Porudzbina {{ $order->slug }}</h4>
			    <hr>
			    <p>{{ $order->status->description }}</p>
			    <div class="d-flex flex-wrap justify-content-between">
			    	<span class="h4">{{ $order->price }} din.</span>
			    	<span class="h4">{{ $order->created_at->diffForHumans() }}</span>
			    </div>
		  	</div>
		  	<ul class="list-group list-group-flush">
		  		<li class="list-group-item text-muted">Proizvodi<span class="ml-auto">Kolicina</span></li>
		  		@foreach($order->products as $product)
					<li class="list-group-item h5">{{ $product->name }}<span class="ml-auto">{{ $product->pivot->amount }}</span></li>
		  		@endforeach
		  	</ul>
		  		<div class="card-block d-flex justify-content-around">
					<a href="{{ route('stores.orders.edit', [$store->slug, $order->slug]) }}" class="btn btn-warning">Izmeni porudzbinu</a>
	  			</div>
		</div>
	</div>