@extends('layouts.shopping')

@section('content')
	<div class="container">
		<ul class="list-group mt-4">
			@foreach($categories as $category)
				<li class="list-group-item">
					<a href="{{ route('shopping.category', [$user->id, $store->id, $category->id]) }}">
						{{ $category->name }}
					</a>
				</li>
			@endforeach
		</ul>
	</div>


@endsection