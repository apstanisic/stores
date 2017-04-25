<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		@include('partials.head')
	</head>
	<body>
		@yield('body')

		@include('partials.bottom')
	</body>
</html>