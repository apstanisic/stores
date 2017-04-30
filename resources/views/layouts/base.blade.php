<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		@include('layouts.partials.head')
	</head>
	<body>
		@yield('body')
		@include('layouts.partials.bottom')
	</body>
</html>