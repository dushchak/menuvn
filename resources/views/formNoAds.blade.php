@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Тарифи для {{$place->name}}</h1>
	
	
	<h3 class="green_element">Рахунок: ${{ @$coins }}</h3>
	<p><a href="https://www.buymeacoffee.com/menu.vn.ua/extras">Поповнити</a></p>

	<form action="{{ route('coins.tariffs', $place) }}" method="POST" >
	@csrf
	<div class="tarifs">

		<div class="tarif__block">
			<div class="tarif__info">
				<h3>"Free"</h3>
				<img src="/images/promos/Ads.png" alt="" width="60">
				<ul>
					<li>QR меню</li>
					<li>Сторінка закладу</li>
					<li>Стороння реклама в меню</li>
				</ul>
			</div>
		</div>
		<div class="tarif__block">
			<div class="tarif__info">
				<h3>"Старт"</h3>
				<img src="/images/promos/noAds.svg" alt="" width="60">
				<ul>
					<li><b>Без реклами в меню</b></li>
					<li>Сторінка закладу</li>
					<li>QR меню</li>
				</ul>
			</div>
			<div class="tarif__radiogroup">
				<p>
					<input type="radio" id="contactChoice1" name="tariff" value="premium1m" checked />
					<label><b>$5</b> - місяць (~200грн)</label>
				</p>
				<p>
					<input type="radio" id="contactChoice1" name="tariff" value="premium12m" />
					<label>$45 - рік (-18%)</label>
				</p>
				<input type="submit" class="btn_submit" value="Оформити">
			</div>
		</div>
		<div class="tarif__block">
			<div class="tarif__info">
				<h3>"Стандарт"</h3>
				<img src="/images/promos/noAds.svg" alt="" width="60">
				<img src="/images/promos/myAds.svg" alt="" width="60">
				<ul>
					
					<li><b>Промо оголошення</b></li>
					<li>Без реклами</li>
					<li>Сторінка закладу</li>
					<li>QR меню</li>

				</ul>
			</div>
			<div class="tarif__radiogroup">
				<p>
					<input type="radio" id="contactChoice1" name="tariff" value="premium1m"/>
					<label><b>$10</b> в місяць</label>
				</p>
				<p>
					
					<input type="radio" id="contactChoice1" name="tariff" value="premium12m" />
					<label>$99 в рік (-18%)</label>
				</p>
				<input type="submit" class="btn_submit" value="Оформити">
			</div>
		</div>
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
					<input type="radio" id="contactChoice1" name="tariff" value="premium1m" />
					<label><b>$25</b> в місяць</label>
				</p>
				<p>
					
					<input type="radio" id="contactChoice1" name="tariff" value="premium12m" />
					<label>$199 в рік (-18%)</label>
				</p>
				<input type="submit" class="btn_submit" value="Оформити">
			</div>
			
		</div>
	</div>
	</form>

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