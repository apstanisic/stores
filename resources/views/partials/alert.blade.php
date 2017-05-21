<div class="alert alert-{{ $type }} my-2  alert-dismissible fade show text-center {{ $classes or '' }}">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
  	</button>
  	<div class="d-flex justify-content-center">
		{{ $message }}
	</div>
</div>

