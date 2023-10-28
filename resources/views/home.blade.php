@extends('layouts.base')



@section ('main')
<h3>Мої заклади</h3>
@if(count ($places) > 0)

    @foreach ($places as $place)
    <div class="oneplace">
        <div class="oneplace__image">
            <img class="oneplaceimg" src="/storage/images/places/{{$place->thumbnail}}" alt="">    
        </div>
        <div class="oneplace__info">
            <h3>{{ $place->name }}</h3>

            <a class="btn_m" href="{{ route('viewMenu', $place->id) }}">Меню</a>
            
            <div class="place__workhours _icon-clock-regular"> {{ $place->workhours }}</div>
            <div class="place__phone1 _icon-location-dot-solid">  {{ $place->adress }}</div>
            <div class="place__sitplaces _icon-users-solid"> {{ $place->sitplaces }} місць</div>
            <div class="place__adress _icon-wifi-solid"> {{ $place->wifipass }}</div>
            <div class="place__delivery _icon-truck-fast-solid"> Доставка: {{ $place->delivery }}</div>
            <div class="place__phone1 bi bi-info-circle">Про нас: {{ $place->description }}</div>
            

            <div class="place__sitplaces _icon-phone-solid"> Керуючий закладом (прихований для користувачів): {{ $place->manager }}</div>
            <div class="place__adress _icon-phone-solid"> Основний тел: {{ $place->phone1 }}</div>
            <div class="place__workhours _icon-phone-solid"> {{ $place->phone2 }}</div>
            <div class="place__delivery _icon-phone-solid"> {{ $place->phone3 }}</div>
            <div class="place__phone1 _icon-phone-solid"> {{ $place->phone4 }}</div>
           

            <div class="place__adress _icon-email-solid"> {{ $place->email }}</div>
            <div class="place__workhours _icon-viber"> {{ $place->viber }}</div>
            <div class="place__delivery _icon-telegram"> {{ $place->telegram }}</div>
            <div class="place__phone1 _icon-instagram">  {{ $place->insta }}</div>
            <div class="place__phone1 _icon-facebook">  {{ $place->fb }}</div>

            <a href="{{ route('place.view', $place->id) }}">Публічна сторінка закладу</a>
            <a href="{{ route('place.edit', $place->id) }}">Редагувати інформацію закладу</a>



            <div class="_icon-coins-solid"> {{ $place->coins }} монет <a href="">+ Монети</a></div>
            
            <div>БЕЗ РЕКЛАМИ в меню до: {{ $place->noadsto }}</div>
            <div>ПРОМО-оголошення АКТИВОВАНО до: {{ $place->adsto }}</div>

            <div class="place__actions">
                <div class="ads-actions">
                    
                    <a href="{{ route('adsPlace', $place->id) }}">PROMO-оголошення {{ $place->name }}</a>
                </div>

                <div class="pay-actions">
                    <a href="{{ route('coins.buyads', $place->id)}}">+Promo</a>
                    <a href="{{ route('coins.formNoAds', $place->id)}}">+NoAds</a> 
                    <a href="{{ route('coins.formUp', $place->id)}}">в ТОП5 списку</a>
                </div>

                
                
            </div>    
        </div>
         
    </div>
    
   
        
    @endforeach
    
@endif
@endsection('main')
