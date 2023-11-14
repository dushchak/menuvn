@extends('layouts.base')




@section ('main')
<div class="bread_crumbs">
    <span>
        <a class="icon_star" href="http://127.0.0.1:8000/"> Білий список</a> >
        <a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a> >
        <span class="bread_crumbs__page">Меню</span>
    </span>
    
    </div>





<h1>{{$place->name}}</h1>


<div class="place__menuinfo">    
    <p class="icon_location-dot"> {{$place->adress}}</p>
    <p class="icon_phone-solid"> {{$place->phone1}}</p>
    <p class="icon_truck-fast"> {{$place->delivery}}</p>   
</div>



<div class="newdish">
    @auth
    <a class="btn_m icon_circle-plus" href="{{route('dish.add', $place->id) }}"> Додати страву</a>
    @endauth
</div>

<div class="anchor_links">
    <h2>МЕНЮ</h2>
    <ul>
        @if($groups['main_dish'])
            <li><a class="link_brown" href="#maindish">Основне меню</a></li>
        @endif
        @if($groups['cold_dish'])
            <li><a class="link_brown" href="#cold_dish"></a>Холодні закуски</li>
        @endif
        @if($groups['hot_dish'])
            <li><a class="link_brown" href="#hot_dish"></a>Гарячі закуски</li>
        @endif
        @if($groups['soup'])
            <li><a class="link_brown" href="#soup">Перші страви</a></li>
        @endif
        @if($groups['garnir'])
            <li><a class="link_brown" href="#garnir">Гарніри</a></li>
        @endif
        @if($groups['salat'])
            <li><a class="link_brown" href="#salat">Салати</a></li>
        @endif
        @if($groups['desert'])
            <li><a class="link_brown" href="#desert">Десерт</a></li>
        @endif
        @if($groups['hot_drink'])
            <li><a class="link_brown" href="#hot_drink">Гарячі напої</a></li>
        @endif
        @if($groups['cold_drink'])
            <li><a class="link_brown" href="#cold_drink">Холодні напої</a></li>
        @endif
        @if($groups['beer'])
            <li><a class="link_brown" href="#beer">Пиво</a></li>
        @endif
        @if($groups['vine'])
            <li><a class="link_brown" href="#vine">Вино</a></li>
        @endif
        @if($groups['hard_alc'])
            <li><a class="link_brown" href="#hard_alc">Міцні напої</a></li>
        @endif
        @if($groups['alc_drink'])
            <li><a class="link_brown" href="#alc_drink">Алкогольні напої</a></li>
        @endif
        @if($groups['coctail'])
            <li><a class="link_brown" href="#coctail">Коктейлі</a></li>
        @endif

    </ul>
</div>




<!-- Розділ меню -->
@if($place->disabled==1)
        <p>Заклад не працює! Меню не доступне!</p>
@endif


<div class="menulist">        
@if($place->disabled==0)
    @if(count ($menu) > 0) 
        @foreach ($menu as $dish)
            @switch($dish->dishgroup)
            @case(1)
                @once
                    <h2 id="maindish">Основне меню</h2>
                @endonce
                @break
            @case(2)
                @once
                    <h2 id="cold_dish">Холодні закуски</h2>
                @endonce
                @break
            @case(3)
                @once
                    <h2 id="hot_dish">Гарячі закуски</h2>
                @endonce
                @break
            
            @case(4)
                @once
                     <h2 id="soup">Перші страви</h2>
                @endonce
                @break
            @case(5)
                @once
                     <h2 id="garnir">Гарніри</h2>
                @endonce
                @break
            @case(6)
                @once
                     <h2 id="salat">Салати</h2>
                @endonce
                @break
            @case(7)
                @once
                    <h2 id="desert">Десерт</h2>
                @endonce
                @break
            @case(8)
                @once
                    <h2 id="hot_drink">Гарячі напої</h2>
                @endonce
                @break
            @case(9)
                @once
                    <h2 id="cold_drink">Холодні напої</h2>
                @endonce
                @break
            @case(10)
                @once
                    <h2 id="beer">Пиво</h2>
                @endonce
                @break
            @case(11)
                @once
                    <h2 id="vine">Вино</h2>
                @endonce
                @break
            @case(12)
                @once
                    <h2 id="hard_alc">Міцні напої</h2>
                @endonce
                @break
            @case(13)
                @once
                    <h2 id="alc_drink">Алкогольні напої</h2>
                @endonce
                @break
            @case(14)
                @once
                    <h2 id="coctail">Коктейлі</h2>
                @endonce
                @break       
            @endswitch



        <div class="dish">
            <div class="dish__image">
                <img class="img" src="/storage/images/dishes/{{$dish->thumbnail}}" alt="">
            </div>
            <div class="dish__info">
                <h4>{{ $dish->dishtitle }}</h4>
                <p>Порція {{ $dish->portionweight }} грам</p>
                @if(!empty($dish->cost100g))
                    <p>за 100г. {{ $dish->cost100g }} грн</p>
                @endif
                
                <p>{{ $dish->description }}</p>

            </div>

            <div class="dish__actions">
                    <p class="dish__cost">{{ $dish->portioncost }} ₴</p>
                    @auth
                    <a class="icon_circle-up" href="{{ route('dish.up', $dish->id)  }}"></a>
                    <a class="icon_circle-down" href="{{ route('dish.down', $dish->id)  }}"></a>
                    <a class="icon_edit" href="{{ route('dish.editdish', $dish->id) }}"></a>
                    <a class="icon_circle-xmark" href="{{ route('dish.formdeldish', $dish->id) }}"></a>                
                    @endauth

            </div>    
        </div>
            
            


     
        @endforeach
  
    @endif
@endif
</div><!-- end menulist -->


<div class="testinfo">
    Lorem ipsum dolor sit amet consectetur adipisicing, elit. Eligendi aspernatur provident pariatur, corrupti placeat molestias tenetur quidem voluptatem vero voluptatibus ipsa vitae, magni quasi quae optio nisi ipsum eius assumenda.
</div>

<div class="footer">
   
    {!! 
        
     QrCode::size(300)
 //       ->style('dot')
        ->eye('circle')
 //       ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
        ->gradient(255, 0, 0, 0, 0, 255, 'diagonal')
        ->margin(1)
        ->generate(Request::url()); 
    !!}
<div>
    <a href="{{ route('printQRpage', $place->id )   }}">Сторінка для друку</a>   
</div>
    

    
</div>
@endsection('main')
<style>
    .navbar {display: none !important;}
</style>
