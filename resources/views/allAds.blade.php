@extends('layouts.base')



@section ('main')

<div class="navbar">
                <h3><a class="icon_star-solid" href=" {{ route('index') }}"> Білий список</a></h3>
                <h3><a class="icon_percent" href=" {{ route('newsAds') }}"> Акції</a></h3>

                
                @auth
                <a class="icon_heart-circle-plus" href=" {{ route('place_add')  }}">Заклад</a>
                    <a class="icon_heart-solid" href=" {{ route('home') }}">Мої заклади</a>
                @endauth
</div>



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
