@extends('layouts.base')



@section ('main')
@if(count ($places) > 0)

    @foreach ($places as $place)
    <div class="place">
        <div class="place__image">
            <img class="" src="/storage/images/places/{{$place->thumbnail}}" alt="">    
        </div>
        <div class="place__info">
            <h3>{{ $place->name }}</h3>
            <div class="place__adress">{{ $place->adress }}</div>
            <div class="place__workhours">Розклад: {{ $place->workhours }}</div>
            <div class="place__sitplaces">Місць: {{ $place->sitplaces }}</div>
            <div class="place__delivery">Доставка: {{ $place->delivery }}</div>
            <div class="place__phone1">Про нас: {{ $place->description }}</div>
            

            <div class="place__sitplaces">Керуючий закладом (прихований для користувачів): {{ $place->manager }}</div>
            <div class="place__adress">Основний тел: {{ $place->phone1 }}</div>
            <div class="place__workhours">тел: {{ $place->phone2 }}</div>
            <div class="place__delivery">тел: {{ $place->phone3 }}</div>
            <div class="place__phone1">тел: {{ $place->phone4 }}</div>
           

            <div class="place__adress">Email: {{ $place->email }}</div>
            <div class="place__workhours">Viber: {{ $place->viber }}</div>
            <div class="place__delivery">Telegram: {{ $place->telegram }}</div>
            <div class="place__phone1">Instagram: {{ $place->insta }}</div>
            <div class="place__phone1">Facebook: {{ $place->fb }}</div>



            <div>Монет: {{ $place->coins }}</div>
            <div class="place__actions">
                <a href="{{ route('place.edit', $place->id) }}">edit</a>
                <a href="{{ route('viewMenu', $place->id) }}">view menu</a>
                <a href="{{ route('ads.new', $place->id) }}">new Ads</a>
                <a href="{{ route('adsPlace', $place->id) }}">view Ads</a>
                <a href="{{ route('coins.buyads', $place->id)}}">Купити 1М реклами</a>
                <a href="">В ТОП списку</a>
                <a href="">Підключитись до tg бота</a>
                <a href="">Активувати тариф "Стандарт" (350/М)</a>
            </div>    
        </div>
         
    </div>
    
   
        
    @endforeach
    
@endif
@endsection('main')
