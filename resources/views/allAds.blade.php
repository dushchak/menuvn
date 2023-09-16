@extends('layouts.base')



@section ('main')
@if(count ($ads) > 0)
<h3>Найкращі пропозиції</h3>
    @foreach ($ads as $adv)
    @if($adv->typeads == 1)
        <div class="adv_txtimg">
    @else
        <div class="adv_txt">
    @endif
        
        <div class="place__adress">{{ $adv->place->name }}</div>
        @if(!empty($adv->img))
        <img class="dish__image" src="/storage/images/ads/{{$adv->img}}" alt="">
        @endif    
        <div class="place__adress">{{ $adv->title }}</div>
        <div class="place__adress">{{ $adv->description }}</div>

        
        <div class="place__actions">
          
        </div> 
    </div>
    
   
        
    @endforeach
    
@endif
@endsection('main')
