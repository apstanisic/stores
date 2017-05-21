<div class="card my-5">
  	<div class="card-block card-inverse card-@include('partials.status_color', compact('status'))">
	    <h4 class="card-title text-center h2">Porudzbina {{ $id }}</h4>
	    <hr>
	    <p>{{ $description }}</p>
	    <div class="d-flex flex-wrap justify-content-between">
	    	<span class="h4">{{ $price }} din.</span>
	    	<span class="h4">{{ $created_at }}</span>
	    </div>
  	</div>
  	@if(isset($editProducts))
		{{ $editProducts }}
  	@else
	  	<ul class="list-group list-group-flush">
	  		<li class="list-group-item text-muted">Proizvodi<span class="ml-auto">Kolicina</span></li>
	  		@foreach($products as $product)
				<li class="list-group-item h5">
					<a href="{{ (isset($owner)) ? route('stores.products.show', [$product->store->slug, $product->slug])
												: route('shopping.products.show', [$product->store->user->slug, $product->store->slug, $product->slug]) }}">
						{{ $product->name }}
					</a>
					{{-- {{ ' ' . $product->price . 'din. ' }} * {{ $product->pivot->amount }} = {{ $product->price * $product->pivot->amount }} --}}
					<span class="ml-auto">
					{{-- {{ $product->pivot->amount }} --}}
					{{ $product->pivot->amount }} * {{ $product->price }} = {{ $product->price * $product->pivot->amount }}
					</span>
				</li>
	  		@endforeach
	  			<li class="list-group-item h5">
	  				<span class="ml-auto">{{ $price }}</span>
	  			</li>
	  	</ul>
  	@endif
  		<div class="card-block">
  			{{ $links }}
		</div>
		{{ $additional or '' }}
</div>