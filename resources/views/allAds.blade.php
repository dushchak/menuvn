@extends('layouts.base')



@section ('main')





@if(count ($ads) > 0)
<h1>Промо-Акції закладів</h1>
    @foreach ($ads as $adv)

        <div class="advert">
    
            @if(!empty($adv->img))
                <img class="advert__image" src="/storage/images/ads/{{$adv->img}}" alt="" title="{{ $adv->description }}">
            @endif
            <div class="advert__text">
                <a href="{{ route('place.view', $adv->place->id) }}">{{ $adv->place->name }}</a>   
                <div class="advert__title">{{ $adv->title }}</div>
                <a class="" href="{{ route('viewMenu', $adv->place->id) }}">Меню</a>
            </div>

            
            <div class="place__actions">
            </div> 
        </div>
        
    @endforeach
    
@endif
@endsection('main')
