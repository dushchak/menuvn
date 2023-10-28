<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title') - Головна сторінка</title>

	<link rel="stylesheet" href="{{asset('css/normalize.min.css')  }} ">
	<link rel="stylesheet" href="css/iconsfont.css">
	<link rel="stylesheet" href="{{asset('css/style.css')  }} ">
	<link rel="stylesheet" href="{{asset('css/style_menu.css')  }} ">
	

</head>
<body>
	<div class="wrap">
		<div class="toppanel">
			<span>
				@guest
					Для закладів:  <a href="{{ route('login') }}">Вхід</a>
				@endguest
				@auth
					<form action="{{ route('logout') }}" method="POST">
						@csrf
						<input type="submit" class="btn" value="Вихід">
					</form>
				@endauth
			</span>
		</div>

		<div class="container">
			<header class="header">
				<a href="{{ route('index') }}"><img class="header__logo" src="{{asset('images/logo.svg') }}" alt="Вінницькі електронні QR меню"></a>
		    </header>

			

			@yield('main')
		</div>
	</div>
	
</body>
</html>	