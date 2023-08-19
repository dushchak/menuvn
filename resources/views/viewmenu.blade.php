@extends('layouts.base')



@section ('main')
<div class="newdish">
    <a href="{{route('dish.add', $place->id) }}">new dish</a>
</div>



<div>
    <h3>{{$place->name}}</h3>
    <p>{{$place->adress}}</p>
    <p>{{$place->phone1}}</p>
    <p>{{$place->delivery}}</p>   
</div>


@if($place->disabled==1)
        <p>Заклад не працює! Меню не доступне!</p>
@endif


        
@if($place->disabled==0)
    @if(count ($menu) > 0) 
 
        @foreach ($menu as $dish)
        @switch($dish->dishgroup)
            @case(1)
                <h3>Основне меню</h3>
                @break
            @case(2)
                <h3>Холодні закуски</h3>
                @break
            @case(3)
                <h3>Гарячі закуски</h3>
                @break
            @case(4)
                <h3>Перші страви</h3>
                @break
            @case(5)
                <h3>Гарніри</h3>
                @break
            @case(6)
                <h3>Салати</h3>
                @break
            @case(7)
                <h3>Десерт</h3>
                @break
            @case(8)
                <h3>Гарячі напої</h3>
                @break
            @case(9)
                <h3>Холодні напої</h3>
                @break
            @case(10)
                <h3>Пиво</h3>
                @break
            @case(11)
                <h3>Вино</h3>
                @break
            @case(12)
                <h3>Міцні напої</h3>
                @break
            @case(13)
                <h3>Алкогольні напої</h3>
                @break
            @case(14)
                <h3>Коктейлі</h3>
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
            <p>Порція, вага: {{ $dish->portionweight }} грам</p>
            <p>Ціна за 100гр: {{ $dish->cost100g }} грн</p>
            <p>Ціна за порцію: {{ $dish->portioncost }} грн</p>
            <p>{{ $dish->description }}</p>
        </div>

            <td>{{ $dish->portioncost }}</td>
            <td>{{ $dish->cost100g }}</td>
            <td>Замовити </td>
            @auth
            <td><a href="{{ route('dish.up', $dish->id)  }}">+</a></td>
            <td><a href="{{ route('dish.down', $dish->id)  }}">-</a></td>
            <td><a href="{{ route('dish.editdish', $dish->id) }}">edit</a></td>
            <td><a href="{{ route('dish.formdeldish', $dish->id) }}">delete</a></td>
            @endauth
            @guest
            <td><a href="">Повідомити про помилку</a></td>
            @endguest
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
