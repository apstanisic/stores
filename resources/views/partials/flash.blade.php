@include('partials.errors')
@if (Session::has('flash_danger'))
	<div class="alert alert-danger my-2  alert-dismissible fade show text-center" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
	  	<p class="alert-message m-0 p-0">
	  		{{ session('flash_danger') }}
	  	</p>
	</div>
@endif
@if (Session::has('flash_success'))
	<div class="alert alert-success my-2  alert-dismissible fade show text-center" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
	  	<p class="alert-message m-0 p-0">
	  		{{ session('flash_success') }}
	  	</p>
	</div>
@endif