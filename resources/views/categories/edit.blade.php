@extends('layouts.dashboard')


@section('content')

	<div class="container">
		<h1 class="text-center mt-5 mb-3">Izmeni kategoriju</h1>
		<form action="{{ route('categories.update', [$store->id, $category->id]) }}" method="post" class="my-5 max-750 mx-auto">
			{{ method_field('patch') }}
			@include('categories.form', ['submitButton' => 'Izmeni'])
		</form>
	</div>

@endsection