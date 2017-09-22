@extends('layouts.dashboard')


@section('content')
<p class="display-4 text-center mt-5">{{ $store->name }}</p>

<p class="h3 text-center mt-4">Napravili ste profit u vrednosti od:</p>
<p class="display-4 text-center">{{ $store->profit }} <small class="h4"> dinar/a.</small></p>
<hr>
<p class="h3 text-center mt-4">Prodali ste ukupno:</p>
<p class="display-4 text-center">{{ $store->soldProducts() }} <small class="h4"> proizvod/a.</small></p>
<hr>
<p class="h3 text-center mt-4">Imate:</p>
<p class="display-4 text-center">{{ $store->buyers()->count() }} <small class="h4"> kupac/a.</small></p>

@endsection