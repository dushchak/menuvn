@extends('layouts.base')



@section ('main')
<h1 class="icon_heart-solid">Мої заклади</h1>

<h3 class="green_element">Рахунок: ${{ @$coins }}</h3>
<p><a href="https://www.buymeacoffee.com/menu.vn.ua/extras">Поповнити</a></p>

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

                    <p><a href="https://www.buymeacoffee.com/menu.vn.ua/extras">Поповнити рахунок</a></p>

                    @if($place->tarif['positionto'])
                        <p>Ваш тариф <b>Premium</b> - до {{ $place->positionto }}</p>

                    @elseif ($place->tarif['adsto'])
                        <p>Ваш тариф <b>Standart</b></p>
                        <p>АКТИВОВАНО до: {{ $place->adsto }}</p>

                    @elseif($place->tarif['noadsto'])
                        <p>Ваш тариф <b>Start</b> -  до {{ $place->noadsto }}
                        </p>
                    @else
                         <p>vash tarif Free</p>
                    @endif
                    
                    @if($place->tarif['noadsto'])
                        <p class="green_element"><a class="icon_toggle-off " href="{{ route('coins.formNoAds', $place->id)}}" title="Відключити рекламу в меню закладу"> Реклама в меню</a>
                            <br>
                       Відключено до: {{ $place->noadsto }}
                        </p>
                    @else
                        <p><a class="icon_toggle-on " href="{{ route('coins.formNoAds', $place->id)}}" title="Відключити рекламу в меню закладу"> Реклама в меню</a>
                        </p>
                    @endif
                    

                   
                        @if($place->tarif['adsto'])
                            <p class="green_element">
                                <a class="icon_toggle-on" href="{{ route('placeAds', $place->id) }}" title="Показувати Промо оголошення"> Ваші Промо-Акції</a>
                                <br>
                            АКТИВОВАНО до: {{ $place->adsto }}
                            </p>
                        @else
                            <p><a class="icon_toggle-off" href="{{ route('placeAds', $place->id) }}" title="Показувати Промо оголошення"> Ваші Промо-Акції</a><br>
                            </p>
                        @endif
                    
                    
                    
                        @if($place->tarif['positionto'])
                            <p class="green_element">
                                <a class="icon_toggle-on" href="{{ route('coins.formUp', $place->id)}}" title="Розмістити в ТОП5 білого списку"> розміщення в ТОП5</a>
                            <br>
                            АКТИВОВАНО до: {{ $place->positionto }}
                            </p>
                        @else
                            <p><a class="icon_toggle-off" href="{{ route('coins.formUp', $place->id)}}" title="Розмістити в ТОП5 білого списку"> Розміщення в ТОП5</a>
                            </p>
                        @endif

                        <p>Скарги та пропозиції пишіть на Telegram: <a href="https://t.me/armtec">@armtec</a></p>
                    
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
