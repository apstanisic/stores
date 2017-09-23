<nav class="navbar navbar-expand-md navbar-dark bg-dark">

	<a class="navbar-brand" href="{{ url('/') }}">
		<h1 class="h3 my-0 p-0 ">
			<img src="{{ asset('img/logo.png') }}" style="height: 32px;"/>
			{{ $title or 'MyStore' }}
		</h1>
	</a>
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>


	<div class="collapse navbar-collapse text-center" id="navbarTogglerDemo02">

		<ul class="navbar-nav mr-auto mt-2 mt-md-0">

			@if(isset($links))
				@foreach($links as $link)
					<li class="nav-item border-bottom-lightgrey py-2 py-sm-0">
						<a class="nav-link" href="{{ route($link->route) }}">{{ $link->name }}</a>
					</li>
				@endforeach
			@endif

			@if(isset($paramLinks))
				@foreach($paramLinks as $link)
					<li class="nav-item border-bottom-lightgrey py-2 py-sm-0">
						<a class="nav-link" href="{{ route($link->route, $link->params) }}">{{ $link->name }}</a>
					</li>
				@endforeach
			@endif

		</ul>

		<div class="d-flex">{{ $right }}</div>
	</div>

</nav>