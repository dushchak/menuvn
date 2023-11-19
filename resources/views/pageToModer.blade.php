@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Сторінку закладу створено!</h1>
	<p>Після перевірки Модератором - сторінка Ресторану буде показуватись клієнтам та відвідувачам сайту</p>
	<p>Щоб прискорити модерацію телефонуйте 068-379-79-74</p>
	<p>Додаткові функції доступні нашим спонсорам на Патреоні</p>
	<p>Посилання на нашу Донат-сторінку <a href="#">donatello.in</a></p>
	<p>Переглянути сторінки ваших закладів можна тут: <a class="icon_heart-solid" href=" {{ route('home') }}">Мої заклади</a></p>
	<p>Переглянути ваші Промо-Акції та оголошення можна тут: <a class="icon_heart-circle-plus" href=" {{ route('ads.listPlaces')  }}">Мої Акції</a></p>
	<p>Додати ще один Заклад харчування: <a class="icon_heart-circle-plus" href=" {{ route('place_add')  }}">Додати заклад</a></p>
	


</div>

@endsection