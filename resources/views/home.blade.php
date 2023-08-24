@extends('layouts.base')



@section ('main')
@if(count ($places) > 0)

    @foreach ($places as $place)
    <div class="place">
        <img class="dish__image" src="/storage/images/places/{{$place->thumbnail}}" alt="">
        <h3>{{ $place->name }}</h3>
        <div class="place__adress">{{ $place->adress }}</div>
        <div class="place__workhours">{{ $place->workhours }}</div>
        <div class="place__delivery">{{ $place->delivery }}</div>
        <div class="place__phone1">{{ $place->phone1 }}</div>
        <div class="place__sitplaces">{{ $place->sitplaces }}</div>
        <div>Монет: {{ $place->coins }}</div>
        <div class="place__actions">
            <a href="{{ route('place.edit', $place->id) }}">edit</a>
            <a href="{{ route('viewMenu', $place->id) }}">view menu</a>
            <a href="{{ route('ads.new', $place->id) }}">new Ads</a>
            <a href="{{ route('adsPlace', $place->id) }}">view Ads</a>
            <a href="{{ route('coins.buyads', $place->id)}}">Купити 1М реклами</a>
            <a href="">В ТОП списку</a>
            <a href="">Підключитись до tg бота</a>
            <a href="">Активувати тариф "Стандарт" (350/М)</a>
        </div> 
    </div>
    
   
        
    @endforeach
    
@endif
@endsection('main')
