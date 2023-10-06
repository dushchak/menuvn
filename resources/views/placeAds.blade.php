@extends('layouts.base')



@section ('main')
<h3>Акції та знижки - {{$place->name}}</h3>
@if(count ($ads) > 0)

<a class="btn btn-success" href="{{ route('ads.new', $place->id) }}">+ Нове оголошення</a>
<a class="btn btn btn-light" href="{{ route('coins.buyads', $place->id)}}">АКТИВУВАТИ оголошення</a>

    
    @foreach ($ads as $adv)
    <div class="promo">
        <div class="advert">
            <img class="advert__image" src="/storage/images/ads/{{$adv->img}}" alt="" title="{{ $adv->description }}">
            <div class="advert__text">
                <div class="advert__title">{{ $adv->title }}</div>               
            </div>

            
        </div>
        <div class="advert__actions">
                <div class="place__actions">
                    <a class="btn btn-success" href="{{ route('ads.editform', $adv) }}">Редагувати</a>   
                </div>
        </div>
    </div>
    
   
        
    @endforeach
    
@endif
@endsection('main')
