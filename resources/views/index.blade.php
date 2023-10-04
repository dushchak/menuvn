

@extends('layouts.base')



@section ('title', 'Онлайн меню Вінниці - qr меню, піццерії, кафе, ресторани та інші заклади харчування міста Вінниці')



@section ('main')
@if(count ($places) > 0)
<table class="table table-striped">
	@foreach ($places as $place)
	<tr>
		<td><img class="dish__image" src="/storage/images/places/{{$place->thumbnail}}" alt=""></td>

		@auth
			<td>Рейтинг: {{ $place->position }}<a href="{{ route('coins.formUp', $place->id) }}">up</a></td>
		@endauth
		<td><a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a></td>
		<td>{{ $place->adress }}</td>
		<td>{{ $place->workhours }}</td>
		<td>{{ $place->viber }}</td>
		<td><a href="{{ route('viewMenu', $place->id) }}">Меню</a></td>
		@php
		echo  count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
		@endphp
		<td><a href="{{ route('adsPlace', $place->id) }}">PROMO-пропозиції</a></td>
		
		

	</tr>
	@endforeach
</table>
@endif
@endsection('main')