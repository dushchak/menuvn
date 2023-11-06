@extends('layouts.base')



@section ('main')
<div class="bread_crumbs">
        <a class="icon_star" href="http://127.0.0.1:8000/"> Білий список</a> >
        <a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a> >
        <span class="bread_crumbs__page">Меню</span>
    
    </div>


<div class="newdish">
    @auth
    <a class="btn_m icon_circle-plus" href="{{route('dish.add', $place->id) }}"> Додати страву</a>
    @endauth
</div>


<h1>{{$place->name}}</h1>

<div class="place__menuinfo">    
    <p class="icon_location-dot"> {{$place->adress}}</p>
    <p class="icon_phone-solid"> {{$place->phone1}}</p>
    <p class="icon_truck-fast"> {{$place->delivery}}</p>   
</div>


@if($place->disabled==1)
        <p>Заклад не працює! Меню не доступне!</p>
@endif


        
@if($place->disabled==0)
    @if(count ($menu) > 0) 
        @php
            $c1=0;
            $c2=0;
            $c3=0;
            $c4=0;
            $c5=0;
            $c6=0;
            $c7=0;
            $c8=0;
            $c9=0;
            $c10=0;
            $c11=0;
            $c12=0;
            $c13=0;
        @endphp
        @foreach ($menu as $dish)
        @switch($dish->dishgroup)
            @case(1)
                @if($c1<1)
                    <h3>Основне меню</h3>
                    @php($c1++)
                @endif
                @break
            @case(2)
                @if($c2<1)
                    <h3>Холодні закуски</h3>
                    @php($c2++)
                @endif
                @break
            @case(3)
                @if($c3<1)
                    <h3>Гарячі закуски</h3>
                    @php($c3++)
                @endif
                @break
            @case(4)
                @if($c4<1)
                    <h3>Перші страви</h3>
                    @php($c4++)
                @endif
                @break
            @case(5)
                @if($c5<1)
                    <h3>Гарніри</h3>
                    @php($c5++)
                @endif
                @break
            @case(6)
                @if($c6<1)
                    <h3>Салати</h3>
                    @php($c6++)
                @endif
                @break
            @case(7)
                @if($c7<1)
                    <h3>Десерт</h3>
                    @php($c7++)
                @endif
                @break
            @case(8)
                @if($c8<1)
                    h3>Гарячі напої</h3>
                    @php($c8++)
                @endif
                @break
            @case(9)
                @if($c9<1)
                    <h3>Холодні напої</h3>
                    @php($c9++)
                @endif
                @break
            @case(10)
                @if($c10<1)
                    <h3>Пиво</h3>
                    @php($c10++)
                @endif
                @break
            @case(11)
                @if($c11<1)
                    <h3>Вино</h3>
                    @php($c11++)
                @endif
                @break
            @case(12)
                @if($c12<1)
                    <h3>Міцні напої</h3>
                    @php($c12++)
                @endif
                @break
            @case(13)
                @if($c13<1)
                    <h3>Алкогольні напої</h3>
                    @php($c13++)
                @endif
                @break
            @case(14)
                @if($c14<1)
                    <h3>Коктейлі</h3>
                    @php($c14++)
                @endif
                @break
            @default
                <h3>Основне меню</h3>
        @endswitch

        <div class="dish">
            <div class="dish__image">
                <img class="img" src="/storage/images/dishes/{{$dish->thumbnail}}" alt="">
            </div>
            <div class="dish__info">
                <h4>{{ $dish->dishtitle }}</h4>
                <p>Порція {{ $dish->portionweight }} грам</p>
                <p>за 100г. {{ $dish->cost100g }} грн</p>
                
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



<div class="testinfo">
    Lorem ipsum dolor sit amet consectetur adipisicing, elit. Eligendi aspernatur provident pariatur, corrupti placeat molestias tenetur quidem voluptatem vero voluptatibus ipsa vitae, magni quasi quae optio nisi ipsum eius assumenda.
</div>

<div class="footer">
   
    {!! 
        
     QrCode::size(400)
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
