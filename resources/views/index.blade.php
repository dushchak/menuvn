
@extends('layouts.base')



@section ('title', 'Онлайн меню Вінниці - qr меню, піццерії, кафе, ресторани та інші заклади харчування міста Вінниці')



@section ('main')
	@if(count ($topplaces) > 0)
	<div class="toplist">
		@foreach ($topplaces as $place)
			<div class="listplace">
				<p>top</p>
				<div class="listplace__img">
					<img class="listplace__image" src="/storage/images/places/{{$place->thumbnail}}" alt="">
				</div>

				<div class="listplace__info">
				
					<h3><a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a></h3>
					<div> {{ $place->adress }}</div>
					<div class="icon_clock"> {{ $place->workhours }}</div>

					<div ><a class="btn_m" href="{{ route('viewMenu', $place->id) }}">Меню</a></div>
					@php
						//echo  count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
						$countads = count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
					@endphp
					<div><a class="place_promos_link" href="{{ route('placeAds', $place->id) }}">Промо-Акції </a>({{$countads}})</div>
				</div>
			</div>

		@endforeach
	</div>
	@endif






@if(count ($places) > 0)
	<div class="listblock">


	@foreach ($places as $place)
	<div class="listplace">
		<div class="listplace__img">
			<img class="listplace__image" src="/storage/images/places/{{$place->thumbnail}}" alt="">
		</div>

		<div class="listplace__info">
			
			<h3><a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a></h3>
			<div> {{ $place->adress }}</div>
			<div class="icon_clock"> {{ $place->workhours }}</div>

			<div ><a class="btn_m" href="{{ route('viewMenu', $place->id) }}">Меню</a></div>
			@php
				//echo  count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
				$countads = count ($place->ads()->latest()->get()); /// кількість оголошень ресторана
			@endphp
			<div><a class="place_promos_link" href="{{ route('placeAds', $place->id) }}">Промо-Акції </a>({{$countads}})</div>
			@auth
								<!-- реклама размещения в ТОП5 -->
			@endauth
		</div>
</div>


	@endforeach
	</div>
@endif
@endsection('main')