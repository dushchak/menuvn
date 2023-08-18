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

        <div class="place__actions">
            <a href="{{ route('place.edit', $place->id) }}">edit</a>
            <a href="{{ route('viewMenu', $place->id) }}">view menu</a>
        </div> 
    </div>
    
   
        
    @endforeach
    
@endif
@endsection('main')
