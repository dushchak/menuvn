@extends('layouts.base')



@section ('main')

<div class="bread_crumbs">
        <a class="icon_star" href="http://127.0.0.1:8000/"> Білий список</a> >
        <a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a> >
        <span class="bread_crumbs__page">Промо-Акції</span>
    
</div>

<h1 class="icon_percent"> Промо-Акції: {{$place->name}}</h1>

@auth
<a class="btn_m" href="{{ route('ads.new', $place->id) }}">+ Нове оголошення</a>
{{$place->adsto}}
@if(count ($ads) > 0)
    <a class="icon_toggle-off adsActiveOff" href="{{ route('coins.buyads', $place->id)}}">АКТИВУВАТИ оголошення</a>
@endif
@endauth


@if(count ($ads) > 0)
    @foreach ($ads as $adv)
    <div class="promo">
        <div class="advert">
            <img class="advert__image" src="/storage/images/ads/{{$adv->img}}" alt="" title="{{ $adv->description }}">
            <div class="advert__text">
                <div class="advert__title">{{ $adv->title }}</div>               
            </div>

            
        </div>
        <div class="advert__actions">
                <div class="adv__actions">
                    @auth
                    <a class="btn btn-success" href="{{ route('ads.editform', $adv) }}">Редагувати</a>
                    @endauth   
                </div>
        </div>
    </div>
    @endforeach  
@endif
@endsection('main')
