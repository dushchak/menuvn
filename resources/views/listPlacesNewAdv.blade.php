
@extends('layouts.base')

@section ('title', 'Онлайн меню Вінниці - qr меню, піццерії, кафе, ресторани та інші заклади харчування міста Вінниці')

@section ('main')


@if(count ($places) > 0)
	<div class="listblock">


		<h1>+ Додати Промо-оголошення</h1>

	@foreach ($places as $place)
	<div class="listplace">


		<div class="listplace__info">
			
			<h3>{{ $place->name }}</h3>
			<div> {{ $place->adress }}</div>



			@php
				//echo  count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
				$countads = count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
			@endphp
			<div>
				<a class="place_promos_link" href="{{ route('placeAds', $place->id) }}">Промо-Акції </a>({{$countads}})
				<p><a class="btn_m" href="{{ route('ads.new', $place->id) }}">+ Нове оголошення</a></p>
			</div>

		</div>
</div>


	@endforeach
	</div>
@endif
@endsection('main')