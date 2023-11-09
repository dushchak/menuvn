@extends('layouts.base')



@section ('main')





@if(count ($ads) > 0)
<h1 class="icon_percent"> Промо закладів</h1>

@auth
    <a class="btn_m" href="{{ route('home') }}">+ Додати ваші оголошення</a>
@endauth
    @foreach ($ads as $adv)

        <div class="advert">
    
            @if(!empty($adv->img))
                <img class="advert__image" src="/storage/images/ads/{{$adv->img}}" alt="" title="{{ $adv->description }}">
            @endif
            <div class="advert__text">
                <a class="link_btn" href="{{ route('place.view', $adv->place->id) }}">{{ $adv->place->name }}</a> > 
                <a class="link_btn" href="{{ route('viewMenu', $adv->place->id) }}">Меню</a>

                <div class="advert__title">{{ $adv->title }}</div>
                
            </div>

            
            <div class="advert__actions">
            </div> 
        </div>
        
    @endforeach
    
@endif
@endsection('main')
