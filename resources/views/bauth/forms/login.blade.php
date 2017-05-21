<form method="post" action="{{ route('buyer.login', [$store->user->slug, $store->slug]) }}" class="mx-auto p-3">
	{{ csrf_field() }}

	<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
		<label for="loginEmail" class="form-control-label">Email</label>
	    <input type="email" name="email" class="form-control" id="loginEmail" value="{{ old('email') }}" required autofocus>
		@if ($errors->has('email'))
            <span class="help-block">
                <strong class="form-control-feedback">{{ $errors->first('email') }}</strong>
            </span>
        @endif
	</div>

    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
	    <div class="d-flex justify-content-between align-items-end flex-wrap">
			<label for="loginPassword"  class="form-control-label">Password</label>
			<a class="btn btn-link" href="{{ route('password.request') }}">
                Zaboravili sifru?
            </a>
        </div>
		<input type="password" name="password" class="form-control" id="loginPassword" required>
		@if ($errors->has('password'))
            <span class="help-block">
                <strong class="form-control-feedback">{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label class="mb-0">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
        </div>
    </div>

    <button type="submit" name="submit" class="btn btn-success btn-block" id="loginButton" value="login">Sign In</button>

</form>