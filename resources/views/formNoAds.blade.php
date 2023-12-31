@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Відключити рекламу: {{$place->name}}</h1>
	<p>Підключіть показ вашої реклами на сторінках Menu.vn.ua. Ви можете показувати цільовій аудиторії ваші оголошення, розкажіть про ваші знижки та акційні пропозиції</p>
	
	<p></p>

	<table class="promo_table">
		<tr>
			<th>Тариф</th>
			<th>Free</th>
			<th>Start</th>
			<th>Standart</th>
			<th>Premium</th>
		</tr>
		<tr>
			<td></td>
			<td>Є реклама в меню</td>
			<td>Без реклами</td>
			<td>Без реклами<br>Розкручуєм Ваші Акції
			</td>
			<td>Без реклами<br> Показ Акцій<br> Топ5</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><img src="/images/promos/noAds.svg" alt=""></td>
			<td>
				<img src="/images/promos/noAds.svg" alt="">
				<img src="/images/promos/myAds.svg" alt="">
			</td>
			<td>
				<img src="/images/promos/noAds.svg" alt="">
				<img src="/images/promos/myAds.svg" alt="">
				<img src="/images/promos/topPlace.svg" alt="">
			</td>
		</tr>
		<tr>
			<td>Місяць</td>
			<td>0</td>
			<td>$ 5</td>
			<td>$ 15</td>
			<td>$ 25</td>
		</tr>
		<tr>
			<td>Рік</td>
			<td>0</td>
			<td>$ 49 (-18%)</td>
			<td>$ 139 (-23%)</td>
			<td>$ 199 (-33%)</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>

	<!-- Buy Me a Coffee Please!  -->
	<a href="https://www.buymeacoffee.com/menu.vn.ua"><img src="https://img.buymeacoffee.com/button-api/?text=Buy me a coffee&emoji=&slug=menu.vn.ua&button_colour=FFDD00&font_colour=000000&font_family=Cookie&outline_colour=000000&coffee_colour=ffffff" /></a>


<form action="{{ route('coins.noads1m', $place) }}" method="POST" >
	@csrf
	<div class="form-group">
		<p>На який час відключити рекламу в Меню:</p>
			<div>
			    <input type="radio" id="contactChoice1" name="period" value="m1" checked />
			    <label for="contactChoice1">1 місяць - 10 монет</label>

			    <input type="radio" id="contactChoice2" name="period" value="m6" />
			    <label for="contactChoice2">6 місяць - 55 монет</label>

			    <input type="radio" id="contactChoice3" name="period" value="m12" />
			    <label for="contactChoice3">12 місяць - 90 монет</label>
			</div>
		<input type="submit" class="btn btn-primary" value="Оплатити">
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