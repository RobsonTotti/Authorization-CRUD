<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
	
	<style>
		html,
		body {
			background-color: #fff;
			color: #636b6f;
			font-family: 'Nunito', sans-serif;
			font-weight: 200;
			height: 100vh;
			margin: 0;
			height: 100%;
		}
	</style>
</head>
<body>
	<div class="flex-center position-ref full-height bg">
		@if (Route::has('login'))
		<div class="top-right links">
			@auth
			<a style="color:  rgb(206, 206, 206)" href="{{ url('/home') }}">Home</a>
			@else
			<a style="color: rgb(206, 206, 206); font-size: 16px;" href="{{ route('login') }}">Login</a>
			@endauth
		</div>
		@endif

		<div class="content">
			<div style="color: white; text-shadow: 2px 2px 2px black;" class="title m-b-md">
				<div>Laravel</div>
			</div>
		</div>
	</div>
</body>
</html>
