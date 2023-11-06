@extends('layouts.base')



@section ('main')
<h1 class="icon_heart-solid">Мої заклади</h1>
@if(count ($places) > 0)

    @foreach ($places as $place)
    <div class="oneplace">
        <div class="oneplace__image">
            <img class="oneplaceimg" src="/storage/images/places/{{$place->thumbnail}}" alt="">    
        </div>
        <div class="oneplace__info">
            <h3> <a href="{{ route('place.view', $place->id) }}">{{ $place->name }}</a></h3>

            <a class="btn_m" href="{{ route('viewMenu', $place->id) }}">Меню</a>
            
            <!-- додати зразок заповнення -->
            <div class="place__workhours icon_clock"> {{ $place->workhours }}</div><!-- * -->
            <div class="place__phone1 icon_location-dot">  {{ $place->adress }}</div><!-- * -->
            <div class="place__sitplaces icon_users"> {{ $place->sitplaces }} місць</div><!-- * -->
            @if($place->wifipass != null)
                <div class="place__adress icon_wifi"> {{ $place->wifipass }}</div><!--  -->
            @endif
            <div class="place__delivery icon_truck-fast">  {{ $place->delivery }}</div><!-- * -->
            <div class="place__phone1 icon_help-info">Про нас: {{ $place->description }}</div><!-- * -->
            

            <div class="place__sitplaces icon_eye-slash"> Керуючий закладом: {{ $place->manager }} (прихований)</div><!-- * -->
            <div class="place__adress icon_phone-solid">  {{ $place->phone1 }}</div><!-- * -->
            @if($place->phone2 != null)
                <div class="place__workhours icon_phone-solid"> {{ $place->phone2 }}</div><!--  -->@endif
            @if($place->phone3 != null)
                <div class="place__delivery icon_phone-solid"> {{ $place->phone3 }}</div><!--  -->@endif
            @if($place->phone4 != null)
                <div class="place__phone1 icon_phone-solid"> {{ $place->phone4 }}</div><!--  -->@endif
           
            @if($place->email != null)
                <div class="place__adress icon_email"> {{ $place->email }}</div><!--  -->@endif
            @if($place->viber != null)
                <div class="place__workhours icon_viber"> {{ $place->viber }}</div><!--  -->@endif
            @if($place->telegram != null)
                <div class="place__delivery icon_telegram"> {{ $place->telegram }}</div><!--  -->@endif
            @if($place->insta != null)
                <div class="place__phone1 icon_instagram">  {{ $place->insta }}</div><!--  -->@endif
            @if($place->fb != null)
                <div class="place__phone1 icon_facebook">  {{ $place->fb }}</div><!--  -->@endif




            <a href="{{ route('place.view', $place->id) }}">Публічна сторінка</a>
            <a class="icon_edit" href="{{ route('place.edit', $place->id) }}">Редагувати</a>



            <div class="icon_wallet"> {{ $place->coins }} монет <a href="">+ Монети</a></div>
            
           

            <div class="place__actions">

                <div class="pay-actions">
                    <p><a class="icon_toggle-on" href="{{ route('coins.formNoAds', $place->id)}}"> Реклама в меню</a> - БЕЗ РЕКЛАМИ в меню до: {{ $place->noadsto }}</p>
                    <p><a class="icon_toggle-off" href="{{ route('coins.buyads', $place->id)}}"> показувати Ваші оголошення</a> - ПРОМО-оголошення АКТИВОВАНО до: {{ $place->adsto }} -  <a href="{{ route('adsPlace', $place->id) }}">Усі ПРОМО-оголошення {{ $place->name }}</a></p>
                    
                    <p><a class="icon_toggle-off" href="{{ route('coins.formUp', $place->id)}}"> в ТОП5 білого списку</a></p>
                </div>

                
                
            </div>    
        </div>
         
    </div>
    
   
        
    @endforeach
    
@endif
@endsection('main')
