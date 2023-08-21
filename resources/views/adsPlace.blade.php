@extends('layouts.base')



@section ('main')
<h2>Акції та знижки</h2>
@if(count ($ads) > 0)
<h3>{{$place->name}}</h3>
    @foreach ($ads as $adv)
    <div class="place">
        <img class="dish__image" src="/storage/images/ads/{{$adv->img}}" alt="">
        <div class="place__adress">{{ $adv->title }}</div>
        <div class="place__workhours">{{ $adv->desctiption }}</div>
        <div class="place__delivery">{{ $adv->typeads }}</div>
        <div class="place__phone1">{{ $adv->payed_at }}</div>
        <div class="place__sitplaces">{{ $adv->moderate }}</div>
        <div class="place__sitplaces">{{ $adv->places_id }}</div>
        <div class="place__sitplaces">{{ $adv->updated_at }}</div>
        <div class="place__sitplaces">{{ $adv->created_at }}</div>

        <div class="place__actions">
            <a href="{{ route('place.edit', 'placeid') }}">edit</a>
            <a href="{{ route('viewMenu', 'placeid') }}">view menu</a>
        </div> 
    </div>
    
   
        
    @endforeach
    
@endif
@endsection('main')
