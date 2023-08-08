<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title') - Головна сторінка</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div class="wrap_main">
		<h1>QR меню Вінниця</h1>
		<h2>Найкращі заклади та меню у Вінниці</h2>
		<div class="navbar">
			<a href="{{ route('index') }}">Головна</a>
			<a href="{{ route('place.add')  }}">+</a>
			<a href="{{ route('home') }}">Мої заклади</a>
			<a href="{{ route('register') }}">Реєстрація</a>
			<a href="{{ route('login') }}">Вхід</a>
			<form action="{{ route('logout') }}" method="POST">
				@csrf
				<input type="submit" class="btn" value="Вихід">
			</form>
		</div>

		@yield('main')
	</div>
	
</body>
</html>	