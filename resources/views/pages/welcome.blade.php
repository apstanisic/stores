@extends('layouts.master')




@section('content')
	<div class="container-fluid bg-dark p-0 mb-5">
		<div class="container">
			<div class="row py-5">

		        <div class="col-12 col-md-6 text-white px-md-5 text-center d-flex align-items-center">
		        	<div>
			        	<h2 class="display-4">Vaša prodavnica</h2>
			        	<p class="h5 my-4">
			        		Napravite prodavnicu za samo nekoliko minuta. Brzo, pouzdano, povoljno.
			        	</p>
		        	</div>
		        </div>

		        <div class="col-12 col-md-6">
		        	@include('auth.forms.register', compact($format = ['hideLabel' => true, 'large' => true, 'placeholder' => true]))
				</div>

		    </div>
	    </div>
    </div>

	<div class="container">

		<div class="row my-5">
			<div class="col-12 display-4 text-center my-5 mx-2">Potpuno besplatno!</div>
		</div>

		<div class="row my-5 mt-5">
			<div class="col-12 col-md-6 h3 pb-3">Najlaksi nacin da počneš da zarađuješ, samo nekoliko minuta je potrebno. Bez komplikovanog programiranja, bez mučenja.</div>
			<div class="col-12 col-md-6">
				<img class="img img-fluid" src="https://membershipworks.com/wp-content/uploads/2014/12/shopping-cart.png" alt="shopping">
			</div>
		</div>

	</div>

@endsection