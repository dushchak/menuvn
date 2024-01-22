@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<div class="textinfo">
		<h1>Сторінку ресторану створено!</h1>
		<p>Після перевірки Модератором - сторінка Ресторану буде показуватись клієнтам та відвідувачам сайту. 
		Щоб прискорити модерацію телефонуйте 068-379-79-74</p>
		<p>Додаткові функції доступні нашим спонсорам</p>
		<p>Посилання на нашу Донат-сторінку <a href="https://www.buymeacoffee.com/menu.vn.ua">BuyMeACoffee</a></p>
		<ul>
			<li>Переглянути сторінки ваших закладів можна тут: <a class="icon_heart-solid" href=" {{ route('home') }}">Мої заклади</a></li>
			<li>Переглянути ваші Промо-Акції та оголошення можна тут: <a class="icon_heart-circle-plus" href=" {{ route('ads.listPlaces')  }}">Мої Акції</a></li>
			<li>Додати ще один Заклад харчування: <a class="icon_heart-circle-plus" href=" {{ route('place_add')  }}">Додати заклад</a></li>
			<li>Додаткові функції: <a href="https://www.buymeacoffee.com/menu.vn.ua/extras">Поповнити рахунок Закладу</a></li>
		</ul>
		
	</div>
	


</div>

@endsection