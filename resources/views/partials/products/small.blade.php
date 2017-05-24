<style>

</style>
<div class="card my-2 mx-auto mx-sm-2 flex-grow text-center" style="min-width: 200px; max-width: 400px;">
	<img class="card-img-top" src="http://placehold.it/250x100" alt="Card image cap">
	<div class="card-block px-2 pb-3 pt-2">
		<h3 class="card-title text-center truncate h6 mb-1 pb-1">{{ $name }}</h3>
		<div class="d-flex justify-content-between mb-2 flex-wrap">
			<span class="card-text ml-1">{{ $price }} din</span>
			<span class="card-text ml-1">Jos {{ $remaining or '' }} <i class="fa fa-archive" aria-hidden="true"></i></span>
		</div>
		<div class="d-flex flex-wrap justify-content-between">
			{{ $routes or '' }}
		</div>
	</div>
</div>