<!DOCTYPE html>
<html lang="uk">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title') - Головна сторінка</title>

	<link rel="stylesheet" href="{{asset('css/normalize.min.css')  }} ">
	<link rel="stylesheet" href="{{asset('css/iconsfont.css') }}">
	<link rel="stylesheet" href="{{asset('css/style.css')  }} ">
	<link rel="stylesheet" href="{{asset('css/style_menu.css')  }} ">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&family=Nunito:ital,wght@0,200;0,400;1,900&family=Roboto&display=swap" rel="stylesheet">


	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-B8N4WSMPTL"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-B8N4WSMPTL');
	</script>
	<!-- end Google tag (gtag.js) -->

	

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
						<input type="submit" class="btn_exit" value="Вихід">
					</form>
				@endauth
			</span>
		</div>

		<main class="main">
			<div class="container">
				<header class="header">
					<a href="{{ route('index') }}"><img class="header__logo" src="{{asset('images/logo.svg') }}" alt="Вінницькі електронні QR меню"></a>
		    	</header>


			    <div class="navbar">
					<h3>
						<a class="icon_star-solid" href=" {{ route('index') }}"> Білий список</a>
					</h3>
					<h3>
						<a class="icon_percent" href=" {{ route('newsAds') }}"> Акції</a>
					</h3>

					
					@auth
						<a class="icon_heart-circle-plus" href="{{ route('place_add')  }}">Додати заклад</a>

						<a class="icon_heart-circle-plus" href=" {{ route('ads.listPlaces')  }}">Мої Акції</a>
						
						<a class="icon_heart-solid" href=" {{ route('home') }}">Мої заклади</a>
					@endauth
				</div>

			

			@yield('main')

			</div>
		</main>


		<footer class="footer">
			<div class="container">
				<h1>Вінницькі QR меню</h1>
				<div class="contacts">
					<p>Адмін: (068) 379-79-74</p>
					<p>free@menu.vn.ua</p>
					<p>Підписуйтесь: <a href="https://t.me/qr_menu_vn">Telegram</a></p>
					

				</div>
				<div class="links">
					<p><a href="{{ route('index') }}">Список закладів</a></p>
					<p><a href="{{ route('newsAds') }}">Акції</a></p>
					<p><a href="{{ route('register') }}">Реєстрація</a></p>
					<p><a href="{{ route('login') }}">Вхід</a></p>
				</div>
				<div class="about">
					<p><a href="{{ route('aboutus') }}">Про сервіс</a></p>
					<p><a href="{{ route('rules') }}">Наші умови та правила</a></p>
					<p><a href="{{ route('faqs') }}">ЧаПи (Часті питання)</a></p>
					<!-- Buy Me a Coffee Please!  -->
						
				</div>

			</div>
			©2023 
		</footer>
	</div>
<script src="{{asset('js/main.js')  }}"></script>
</body>
</html>	