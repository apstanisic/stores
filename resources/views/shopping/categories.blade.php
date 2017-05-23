@extends('layouts.shopping')

@section('content')
	<div class="container">
		<ul class="list-group mt-4">
			@foreach($categories as $category)
				<ol class="breadcrumb">
					@foreach($category->parents as $parent)
						<li class="breadcrumb-item">
							<a href="{{ route('shopping.categories.show', [$parent->store->user->slug, $parent->store->slug, $parent->slug]) }}">
								<span class="text-muted">{{ $parent->name }}</span>
							</a>
						</li>
					@endforeach
					<li class="breadcrumb-item active h4">
						<a href="{{ route('shopping.categories.show', [$category->store->user->slug, $category->store->slug, $category->slug]) }}">
							<span class="text-primary">{{ $category->name }}</span>
						</a>
					</li>
				</ol>
			@endforeach
		</ul>
	</div>


@endsection