@extends('layouts.dashboard')

@section('content')
	@include('partials.orders.order', compact('order'))
@endsection