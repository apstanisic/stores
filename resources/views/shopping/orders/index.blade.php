@extends('layouts.shopping')

@php
	$i = 1;
@endphp

@section('content')
	<div class="container">
		<h1 class="text-center m-4">Porudzbine</h1>
			@foreach($orders as $order)
				<div class="card m-3">
					<div class="card-header card-inverse card-@include('partials.status_color', ['status' => $order->status->name]) text-white">
					{{-- {{ $order->status->description }} --}}
					<p class="h4">{{ $order->slug }}</p>
					</div>
					<div class="card-block">
						<h4 class="card-title">{{ $i++ . '. ' . $order->created_at->diffForHumans() }}</h4>
						<p>Cena je: <strong>{{ $order->price }} dinara</strong>, i sadrzi {{ count($order->products) }} proizvod/a.</p>
						<a href="{{ route('buyer.orders.show', [$order->store->user->slug, $order->store->slug, $order->slug]) }}" class="btn btn-primary">Detaljnije</a>
						@if($order->canEdit())
							<a href="{{ route('buyer.orders.edit', [$order->store->user->slug, $order->store->slug, $order->slug]) }}" class="btn btn-primary">Izmeni</a>
						@endif
					</div>
				</div>
			@endforeach
	</div>
@endsection