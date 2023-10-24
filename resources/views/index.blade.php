

@extends('layouts.base')



@section ('title', 'Онлайн меню Вінниці - qr меню, піццерії, кафе, ресторани та інші заклади харчування міста Вінниці')



@section ('main')
@if(count ($places) > 0)
	<div class="listblock">


	@foreach ($places as $place)
	<div class="listplace">
		<div class="listplace__img">
			<img class="listplace__image" src="/storage/images/places/{{$place->thumbnail}}" alt="">
		</div>

		<div class="listplace__info">
			
			<h3><a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a></h3>
			<div>{{ $place->adress }}</div>
			<div>{{ $place->workhours }}</div>

			<div><a href="{{ route('viewMenu', $place->id) }}">Меню</a></div>
			@php
				//echo  count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
				$countads = count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
			@endphp
			<div><a href="{{ route('adsPlace', $place->id) }}">PROMO-Акції ({{$countads}})</a></div>
			@auth
				<p>Рейтинг: {{ $place->position }}<a href="{{ route('coins.formUp', $place->id) }}">up</a></p>

				
			@endauth
		</div>
</div>


	@endforeach
	</div>
@endif
@endsection('main')