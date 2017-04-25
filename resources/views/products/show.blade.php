@extends('layouts.dashboard')


@section('content')
<p class="display-4 text-center">{{ $product->name }}</p>
<p class="display-4 text-center">{{ $product->description }}</p>
<p class="display-4 text-center">{{ $product->price }} din</p>
<p class="display-4 text-center">{{ $product->remaining }}</p>
<p class="display-4 text-center">{{ $product->store->name }}</p>

Neki podaci o proizvodu <hr>
Broj kupljenih <hr>
 itd.	<hr>
itd

@endsection