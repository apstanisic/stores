@extends('layouts.shopping')

@section('content')
	<div class="container">
		<ul class="list-group mt-4">
			@foreach($categories as $category)
				<li class="list-group-item">
					<a href="{{ route('shopping.categories.show', [$category->store->user->slug, $category->store->slug, $category->slug]) }}">
						{{ $category->name }}
					</a>
				</li>
			@endforeach
		</ul>
	</div>


@endsection