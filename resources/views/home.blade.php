@extends('layouts.base')



@section ('main')
<h1 class="icon_heart-solid">Мої заклади</h1>

<h3>Рахунок: ${{ @$coins }}</h3>

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
            @if($place->workhours != null)
                <div class="place__workhours icon_clock"> {{ $place->workhours }}</div><!-- * -->
            @endif
            <div class="place__phone1 icon_location-dot">  {{ $place->adress }}</div><!-- * -->
            @if($place->sitplaces != null)
                <div class="place__sitplaces icon_users"> {{ $place->sitplaces }} місць</div><!-- * -->
            @endif
            @if($place->wifipass != null)
                <div class="place__adress icon_wifi"> {{ $place->wifipass }}</div><!--  -->
            @endif
            @if($place->delivery != null)
                <div class="place__delivery icon_truck-fast">  {{ $place->delivery }}</div><!-- * -->
            @endif
            <div class="place__phone1 icon_help-info"> Про нас: {{ $place->description }}</div><!-- * -->
            

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
            




           <p> <a class="icon_edit link_btn" href="{{ route('place.edit', $place->id) }}">Редагувати: {{ $place->name}}</a></p>


            @if($place->disabled != null)
                <div class="place__sitplaces icon_eye-slash alert_text">Заклад відключено (немає в Білому списку)</div><!-- * -->
            @endif

           
            

            <div class="place__actions">
                @auth
                <div class="pay-actions">
                    <p><a class="icon_toggle-on " href="{{ route('coins.formNoAds', $place->id)}}" title="Відключити рекламу в меню закладу"> Реклама в меню</a>   <br>
                    @if(true)

                    @else
                        БЕЗ РЕКЛАМИ до: {{ $place->noadsto }}
                    @endif
                    </p>

                    <p><a class="icon_toggle-off" href="{{ route('placeAds', $place->id) }}" title="Показувати Промо оголошення"> Ваші Промо-Акції</a><br>
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
    @endforeach

@elseif (count ($places) == 0)
    @auth
        <a class="btn_m" href=" {{ route('place_add')  }}">+ Додати заклад</a>
    @endauth

    
@endif
@endsection('main')
