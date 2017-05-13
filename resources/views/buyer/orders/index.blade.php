@extends('layouts.shopping')

@php
	$i = 1;
@endphp

@section('content')
	<div class="container">
		<h1 class="text-center m-4">Porudzbine</h1>
			@foreach($orders as $order)
				<div class="card m-3">
					<div class="card-header card-inverse card-@include('partials.status_color') text-white">
					{{ $order->status->description }}
					</div>
					<div class="card-block">
						<h4 class="card-title">{{ $i++ . '. ' . $order->created_at->diffForHumans() }}</h4>
						<p>Cena je: <strong>{{ $order->price }} dinara</strong>, i sadrzi {{ count($order->products) }} proizvod/a.</p>
						<a href="{{ route('buyer.orders.show', [$store->user->id, $store->id, $order->id]) }}" class="btn btn-primary">Detaljnije</a>
					</div>
				</div>
			@endforeach
	</div>
@endsection