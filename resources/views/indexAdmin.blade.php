@extends('layouts.base')



@section ('main')
<h1>Admin panel</h1>
<div class="adminPanel">


	<div class="adminPanel__placestomoder">
		<h3>Нові заклади</h3>
		@if(count ($newplaces) > 0)
		<div class="">
			<table>
			@foreach ($newplaces as $place)
				<tr>
					<td><a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a></td>
					<td>
						@php
							//echo  count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
							$countads = count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
						@endphp
						<a href="{{ route('adsPlace', $place->id) }}">PROMO-Акції ({{$countads}})</a>
					</td>
					<td>
						@auth
							Рейтинг: {{ $place->position }}<a href="{{ route('coins.formUp', $place->id) }}">up</a>
						@endauth
					</td>
					<td>
						@auth
							Модерація закладу: <a href="{{ route('admin.moderate', $place->id) }}">Включити</a>
						@endauth
					</td>
				</tr>
			@endforeach
			</table>
		</div>
		@endif
	</div>

	<!-- list places -->
	<div class="adminPanel__placestomoder">
		<h3>Список закладів</h3>
		@if(count ($places) > 0)
		<div class="">
			<table>
				<tr>
					<th>Заклад</th>
					<th>Promos</th>
					<th>Рейт</th>
					<th>Модер</th>
					<th>Монети</th>
					<th></th>
					<th>без реклам до</th>
					<th>Промо до</th>
					<th>Топ до</th>
				</tr>
			@foreach ($places as $place)
				<tr>
					<td><a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a></td>
					<td>
						@php
							//echo  count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
							$countads = count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
						@endphp
						<a href="{{ route('adsPlace', $place->id) }}">PROMO ({{$countads}})</a>
					</td>
					<td>
						@auth
							Рейтинг: {{ $place->position }}<a href="{{ route('coins.formUp', $place->id) }}">up</a>
						@endauth
					</td>
					<td>
						@auth
							Модерація закладу: <a href="{{ route('admin.blockPlace', $place->id) }}">Выключити Х</a>
						@endauth
					</td>
					<td>{{ $place->coins()->first('coins_after') }} </td>
					<td><a href="{{route('coins.formAdd', $place->id)}}"> ++Монети</a></td>
					<td>
						{{ $place->noadsto }}
					</td>
					<td>{{ $place->adsto }}</td>
					<td>{{ $place->positionto}}</td>
				</tr>
			@endforeach
			</table>
		</div>
		@endif
	</div>


	<div class="admin_item">
		<h3>Скарги</h3>
		foreach
		<p>Placename Dishid dishname cost datetime read/unread</p>
	</div>
	<p>
		Підключено закладів: 76 закладів <br>
		Куплено реклами 1м : 5 закладів <br>
		куплено Up 1м: 5 закладів <br>
		куплено стилів QR 1м: 5 закладів <br>
		Відключено рекламу 6м: 5 закладів <br>
		Відключено рекламу 12м: 5 закладів <br>
	</p>
	<table>
		<th>
			<dt>Показник</dt>
			<dt>7д</dt>
			<dt>30д</dt>
			<dt>90д</dt>
		</th>
		<tr>
			<dt>Переглядів меню</dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
		<tr>
			<dt>Переглядів index</dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
		<tr>
			<dt></dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
		<tr>
			<dt></dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
		<tr>
			<dt></dt>
			<dt></dt>
			<dt></dt>
			<dt></dt>
		</tr>
	</table>
</div>


@endsection('main')