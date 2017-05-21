@extends('layouts.master')


@section('content')

<div class="container">
	<div class="row">
		<div class="col-lg mt-4 d-flex justify-content-center align-items-stretch flex-column border-1 mx-2">
			<p class="h2 text-center">Izmenite podatke</p>

			<form action="{{ route('user.update') }}" method="post">
				{{ csrf_field() }}
				{{ method_field('patch') }}

				<div class="form-group">
					<label for="changeUsername">Username</label>
					<input type="text" name="username" class="form-control" id="changeUsername" value="{{ $user->username }}">
				</div>

				<div class="form-group">
					<label for="changeEmail">Email</label>
					<input type="text" name="email" class="form-control" id="changeEmail" value="{{ $user->email }}">
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-warning btn-block">Izmeni</button>
				</div>

			</form>

		</div>

		<div class="col-lg mt-4 border-1 mx-2 py-3">
			<p class="h2 text-center">Izmenite lozinku</p>

			<form action="{{ route('user.updatePassword') }}" method="post">
				{{ csrf_field() }}
				{{ method_field('patch') }}

				<div class="form-group">
					<label for="oldPassword">Stara</label>
					<input type="password" name="old_password" class="form-control" id="oldPassword" placeholder="Stari password" required>
				</div>

				<div class="form-group">
					<label for="newPassword">Password</label>
					<input type="password" name="password" class="form-control" id="newPassword" placeholder="Novi password" required>
				</div>

				<div class="form-group">
					<label for="newPasswordConfirmed">Ponovi</label>
					<input type="password" name="password_confirmation" class="form-control" id="newPasswordConfirmed" placeholder=" Ponovi password" required>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-warning btn-block">Izmeni</button>
				</div>

			</form>

		</div>

		<div class="col-12 mt-4 border-1 p-3">
			<form action="{{ route('user.destroy') }}" method="post">
				{{ csrf_field() }}
				{{ method_field('delete') }}
				<div class="form-group">
					<button type="submit" class="btn btn-danger btn-block" id="profileDelete" disabled>Izbrisi profil</button>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-danger btn-block" id="enableProfileDelete">Dupli klik da omogucite brisanje</button>
				</div>
				<div  class="form-group" id="profileDeleteHidden" style="display: none;">
					<label for="usernameProfileDelete">Ukucajte vas username, da biste obrisali profil</label>
					<input type="text" class="form-control" name="username" placeholder="Username" id="usernameProfileDelete">
				</div>
			</form>
		</div>

	</div>
</div>

@endsection