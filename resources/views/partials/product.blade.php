<div class="card m-2" style="width: 220px;">
	<img class="card-img-top" src="http://placehold.it/250x100" alt="Card image cap">
	<div class="card-block">
		<h5 class="card-title text-center">{{ $name }}</h5>
		<div class="d-flex justify-content-between mb-2 flex-wrap">
			<span class="card-text ml-1">{{ $price }} din</span>
			<span class="card-text ml-1">Jos {{ $remaining or '' }} <i class="fa fa-archive" aria-hidden="true"></i></span>
		</div>
		<div class="d-flex flex-wrap justify-content-between">
			{{ $links or '' }}
		</div>
	</div>
</div>