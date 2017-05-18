<form method="post"  action="{{ route('buyer.register', [$user->slug, $store->slug]) }}" class="mx-auto max-500">
	{{ csrf_field() }}

	<div class="form-group mb-3">
		{!! (!isset($format['hideLabel'])) ? '<label for="signUpUsername">Username</label>' : '' !!}

	    <input type="text" name="username" class="form-control{!! (isset($format['large'])) ? ' form-control-lg' : '' !!}"
	     id="signUpUsername" {!! (isset($format['placeholder'])) ? 'placeholder="Username"' : '' !!} required autofocus>

	</div>

	<div class="form-group mb-3">
		{!! (!isset($format['hideLabel'])) ? '<label for="signUpEmail">Email</label>' : '' !!}

	    <input type="email" name="email" class="form-control{!! (isset($format['large'])) ? ' form-control-lg' : '' !!}"
	     id="signUpEmail" {!! (isset($format['placeholder'])) ? 'placeholder="Email"' : '' !!} required>

	</div>

    <div class="form-group mb-3">
		{!! (!isset($format['hideLabel'])) ? '<label for="signUpPassword">Password</label>' : '' !!}

		<input type="password" name="password" class="form-control{!! (isset($format['large'])) ? ' form-control-lg' : '' !!}"
		 id="loginPassword"  {!! (isset($format['placeholder'])) ? 'placeholder="Password"' : '' !!} required>

    </div>

    <button type="submit" name="submit" class="btn btn-warning btn-block{!! (isset($format['large'])) ? ' btn-lg' : '' !!}"
     id="signUpButton" value="signUp">Registrujte se</button>

</form>