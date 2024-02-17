@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Тарифи для {{$place->name}}</h1>
	<h2>Розміщення в ТОП 5 "Білого списку"</h2>
	<p>Ваш Заклад гарантовано буде на вершині "Білого списку" і на першій сторінці Menu.vn.ua серед 5 найТОПовіших вінницьких закладів. </p>
	
	
	<h3 class="green_element">Рахунок: ${{ @$coins }}</h3>
	<p><a href="https://www.buymeacoffee.com/menu.vn.ua/extras">Поповнити</a></p>

	<form action="{{ route('coins.tariffs', $place) }}" method="POST" >
	@csrf
	<div class="tarifs">
		<div class="tarif__block">
			<div class="tarif__info">
				<h3>"Преміум"</h3>
				<img src="/images/promos/noAds.svg" alt="" width="60">
				<img src="/images/promos/myAds.svg" alt="" width="60">
				<img src="/images/promos/topPlace.svg" alt="" width="60">
				<ul>
					<li><b>Розміщення в ТОП5</b></li>
					<li>Промо оголошення</li>
					<li>Без реклами в меню</li>
					<li>Сторінка закладу</li>
					<li>QR меню</li>
					
				</ul>
			</div>
			<div class="tarif__radiogroup">
				<p>
					<input type="radio" id="contactChoice1" name="tariff" value="premium1m" checked/>
					<label><b>$25</b> в місяць</label>
				</p>
				<p>
					
					<input type="radio" id="contactChoice1" name="tariff" value="premium12m" />
					<label>$199 в рік (-33%)</label>
				</p>
				<input type="submit" class="btn_submit" value="Оформити">
			</div>
			
		</div>
	</div>
	</form>
	<p class="articles_promo">
		<b>Розміщення прямих посиланнь(a href) лінків</b> на ваші інтернет сайти - <b>$30 в рік</b>.
		Розміщення відбувається в тематичних статтях про ваш заклад. Щодо розміщення ссилок на сайти з тематикою - Закладів харчування Вінниці - звертайтесь на контакти внизу сторінки.
		<br>
		Посилання розміщуються незалежно від тарифів.
	</p>




	<div class="valid_errors">
		@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	</div>
</div>

@endsection