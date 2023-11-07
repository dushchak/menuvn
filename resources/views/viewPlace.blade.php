@extends('layouts.base')



@section ('main')

<div class="bread_crumbs">
        <a class="icon_star" href="http://127.0.0.1:8000/"> Білий список</a> >
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

            @auth
                <p> <a class="icon_edit" href="{{ route('place.edit', $place->id) }}">Редагувати: {{ $place->name}}</a></p>
            @endauth



            <div class="place__actions">
                @auth
                <div class="pay-actions">
                    <p><a class="icon_toggle-on" href="{{ route('coins.formNoAds', $place->id)}}" title="Відключити рекламу в меню закладу"> Реклама в меню</a>   <br>
                    @if(true)

                    @else
                        БЕЗ РЕКЛАМИ до: {{ $place->noadsto }}
                    @endif
                    </p>

                    <p><a class="icon_toggle-off" href="{{ route('coins.buyads', $place->id)}}" title="Показувати Промо оголошення"> Ваші Промо-Акції</a><br>
                        @if(false)
                            АКТИВОВАНО до: {{ $place->adsto }}
                        @else
                            
                        @endif
                    </p>
                    
                    <p><a class="icon_toggle-off" href="{{ route('coins.formUp', $place->id)}}" title="Розмістити в ТОП5 білого списку"> розміщення в ТОП5</a></p>
                </div>
                @endauth
            </div>  



        </div>
         
    </div>

@endsection('main')