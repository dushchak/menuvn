@extends('layouts.base')



@section ('main')

<div class="bread_crumbs">
        <a class="icon_star" href="{{ route('index') }}"> Білий список</a> >
        <span class="bread_crumbs__page">{{ $place->name }}</span> >
        <a href="{{ route('viewMenu', $place->id) }}">Меню</a>
    
    </div>


    <div class="oneplace">
        <div class="oneplace__image">
            <img class="oneplaceimg" src="/storage/images/places/{{$place->thumbnail}}" alt="">    
        </div>
        <div class="place__info">
            <h3>{{ $place->name }}</h3>
            
<!-- додати зразок заповнення -->
            <div class="place__workhours icon_clock"> {{ $place->workhours }}</div><!-- * -->
            <div class="place__phone1 icon_location-dot">  {{ $place->adress }}</div><!-- * -->
            <div class="place__sitplaces icon_users"> {{ $place->sitplaces }} місць</div><!-- * -->
            @if($place->wifipass != null)
                <div class="place__adress icon_wifi"> {{ $place->wifipass }}</div><!--  -->
            @endif
            <div class="place__delivery icon_truck-fast">  {{ $place->delivery }}</div><!-- * -->
            <div class="place__phone1 icon_help-info"> Про нас: {{ $place->description }}</div><!-- * -->
            <br>
            

            <div class="place__adress icon_phone-solid">  {{ $place->phone1 }}</div><!-- * -->
            @if($place->phone2 != null)
                <div class="place__workhours icon_phone-solid"> {{ $place->phone2 }}</div><!--  -->@endif
            @if($place->phone3 != null)
                <div class="place__delivery icon_phone-solid"> {{ $place->phone3 }}</div><!--  -->@endif
            @if($place->phone4 != null)
                <div class="place__phone1 icon_phone-solid"> {{ $place->phone4 }}</div><!--  -->@endif
           
            
            @if($place->insta != null)
                <div class="place__phone1 icon_instagram">  {{ $place->insta }}</div><!--  -->@endif
            @if($place->fb != null)
                <div class="place__phone1 icon_facebook">  {{ $place->fb }}</div><!--  -->@endif

                
            <div><a class="btn_m" href="{{ route('viewMenu', $place->id) }}">Меню</a></div>


           
             @can('updatePlace', $place)

                <p class="manager_highlight">Менеджер закладу:</p>
                <div class="manager_highlight icon_eye-slash"> Керуючий закладом: {{ $place->manager }} (прихований)</div><!-- * -->
                    @if($place->email != null)
                        <div class="manager_highlight icon_email"> {{ $place->email }}</div><!--  -->@endif
                    @if($place->viber != null)
                        <div class="manager_highlight icon_viber"> {{ $place->viber }}</div><!--  -->@endif
                    @if($place->telegram != null)
                        <div class="manager_highlight icon_telegram"> {{ $place->telegram }}</div><!--  -->@endif
                <br>
 
                <p> <a class="icon_edit link_btn" href="{{ route('place.edit', $place->id) }}"> Редагувати: {{ $place->name}}</a></p>
           
         



                <div class="place__actions"> 
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

                        <p>Скарги та пропозиції пишіть на Telegram: <a href="https://t.me/armtec">@armtec</a></p>
                    </div>
                </div> 
         @endcan   



        </div>
         
    </div>

@endsection('main')