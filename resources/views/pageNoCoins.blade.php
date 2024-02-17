@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Недостатньо монет - {{$place->name}}</h1>
	<p>Додаткові послуги сайту платні або доступні для патронів, які роблять внески на сайті BuyMeACoffe.com</p>
	<p>Проєкт не може бути повністю безкоштовним, тому дякуємо за розуміння!</p>
	
	<h3 class="green_element">Ваш Рахунок: ${{ @$coins }}</h3>
	<p><a href="https://www.buymeacoffee.com/menu.vn.ua/extras">Поповнити</a></p>
	


</div>

@endsection