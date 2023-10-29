@extends('layouts.base')



@section ('main')

<div class="bread_crumbs">
        <a href="http://127.0.0.1:8000/">Білий список</a> >
        <span class="bread_crumbs__page">{{ $place->name }}</span> >
        <a href="{{ route('viewMenu', $place->id) }}">Меню</a>
    
    </div>


    <div class="oneplace">
        <div class="oneplace__image">
            <img class="oneplaceimg" src="/storage/images/places/{{$place->thumbnail}}" alt="">    
        </div>
        <div class="place__info">
            <h3>{{ $place->name }}</h3>
            
            <div class="place__workhours">Розклад: {{ $place->workhours }}</div>
            <div class="place__sitplaces">Місць: {{ $place->sitplaces }}</div>
            <div class="place__adress">Wi-Fi: {{ $place->wifipass }}</div>
            <div class="place__delivery">Доставка: {{ $place->delivery }}</div>
            <div class="place__phone1">Про нас: {{ $place->description }}</div>
            

           
            <div class="place__adress">Основний тел: {{ $place->phone1 }}</div>
            <div class="place__workhours">тел: {{ $place->phone2 }}</div>
            <div class="place__delivery">тел: {{ $place->phone3 }}</div>
            <div class="place__phone1">тел: {{ $place->phone4 }}</div>
           

            <div class="place__adress">Email: {{ $place->email }}</div>
            <div class="place__workhours">Viber: {{ $place->viber }}</div>
            <div class="place__delivery">Telegram: {{ $place->telegram }}</div>
            <div class="place__phone1">Instagram: {{ $place->insta }}</div>
            <div class="place__phone1">Facebook: {{ $place->fb }}</div>



            <div class="place__actions">
                <a class="btn_m" href="{{ route('viewMenu', $place->id) }}">Меню</a>
                @auth
                    <a href="{{ route('place.edit', $place->id) }}">Редагувати інформацію</a>
                    
                    <a href="{{ route('ads.new', $place->id) }}">+Нове Промо</a>
                    <a href="{{ route('adsPlace', $place->id) }}">Промо-акції закладу</a>
                    <a href="{{ route('coins.buyads', $place->id)}}">Вкл. промо</a>
                    <a href="{{ route('coins.formNoAds', $place->id)}}">Викл. рекламу</a>
                    
                    <a href="">В ТОП списку</a>
                    <a href="">Підключитись до tg бота</a>
                    <a href="">Активувати тариф "Стандарт" (350/М)</a>
                @endauth
            </div>    
        </div>
         
    </div>

@endsection('main')