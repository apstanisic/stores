@extends('layouts.dashboard')

@section('content')
		@include('partials.orders.orders', compact('orders'))
@endsection