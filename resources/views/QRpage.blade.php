@extends('layouts.printpage')



@section ('main')
<div class="printQR">
       <div class="noprint">
              <form class="qrstyleform" action="{{  route('printQRstyle', $place) }}" method="POST">
                     @csrf
                     <div class="qrstyleform__items">
                            <div class="qrstyleform_dots">
                                   <input type="hidden" name="menuurl" value="{{ $menuurl }}">
                                   <input type="radio" id="contactChoice1" name="stlqr" value="square" checked />
                                   <label for="contactChoice1">Квадрати</label>

                                   <input type="radio" id="contactChoice2" name="stlqr" value="dot" />
                                   <label for="contactChoice2">Точки</label>
                            </div>

           

                           <div class="qrstyleform__size">
                                   <label for="">Розмір</label>
                                   <select name="qrsize">
                                          <option value="900">900</option>
                                          <option value="700">700</option>
                                          <option value="500" selected="selected">500</option>
                                          <option value="300">300</option>
                                          <option value="200">200</option>
                                          
                                   </select>
                            </div>



             
                            <div class="qrstyleform__color">
                                   <p>Кольори QR кода:</p>
                                   <label for="head">Точки</label>
                                   <input type="color" id="head" name="qrcolor" value="#00008B" />
                              
                                   <label for="body">Фон</label>
                                   <input type="color" id="body" name="qrbg" value="#ffffff" />
                              
                            </div>

                            <p>або</p>

                            <div class="qrstyleform__gradient">
                                  <label for="head"><b>QR код з градієнтом:</b></label>
                                   <input id="grad_checkbox" type="checkbox" name="grad" value="1">
                                   <br>

                                   <label for="head">Колір 1</label>
                                   <input type="color" id="head" name="grad_col_1" value="#0000FF" />
                              
                                   <label for="body">Колір 2</label>
                                   <input type="color" id="body" name="grad_col_2" value="#D2691E" />
                              
                            </div>



                   
                     </div>
                     <button type="submit">Застосувати</button>
                     <p>Друкувати: "Ctrl" + "P"</p>
                     <hr>
              </form>
       </div>


	<h1 style="color:{{ $qrstyle->headercolor }};">Меню "{{ $place->name }}"</h1>
	      @if($place->wifipass != null)
                <div class="place__adress icon_wifi">Пароль WiFi: {{ $place->wifipass }}</div><!--  -->
            @endif
   








@if($qrstyle->qrsize === null)
       {!!
       /* https://www.simplesoftware.io/#/docs/simple-qrcode/ru */
       /* https://github.com/SimpleSoftwareIO/simple-qrcode */

       QrCode::size(400)
              ->style('square')
              ->eye('circle')
              //->backgroundColor($qrstyle->bg[0], $qrstyle->bg[1], $qrstyle->bg[2])
              ->gradient(255, 0, 0, 0, 0, 255, 'diagonal')
              ->margin(10)
              ->errorCorrection('H')
              ->generate( $menuurl ); 
   
       !!}
@elseif ($qrstyle->grad == 1)
       {!!
              /* градиент цветов точек кода */
              QrCode::size($qrstyle->qrsize)
              ->style($qrstyle->stlqr)
              ->eye('circle')
              ->backgroundColor($qrstyle->qrbg[0], $qrstyle->qrbg[1], $qrstyle->qrbg[2])
              ->gradient($qrstyle->grad_col_1[0], $qrstyle->grad_col_1[1], $qrstyle->grad_col_1[2], $qrstyle->grad_col_2[0], $qrstyle->grad_col_2[1], $qrstyle->grad_col_2[2], 'diagonal')
              //->gradient(255, 0, 0, 0, 0, 255, 'diagonal')
              ->margin(10)
              ->errorCorrection('H')
              ->generate( $menuurl ); 
       !!}

@else
       {!!

       /* цвет и фон */
       QrCode::size($qrstyle->qrsize)
       //QrCode::size(400)
              //->style('dot')
              ->style($qrstyle->stlqr)
              ->eye('circle')
              ->color($qrstyle->qrcolor[0],$qrstyle->qrcolor[1],$qrstyle->qrcolor[2])
              ->backgroundColor($qrstyle->qrbg[0], $qrstyle->qrbg[1], $qrstyle->qrbg[2])
            //->gradient($qrstyle->grad_col_1[0], $qrstyle->grad_col_1[1], $qrstyle->grad_col_1[2], $qrstyle->grad_col_2[0], $qrstyle->grad_col_2[1], $qrstyle->grad_col_2[2], 'diagonal')
              ->format('svg')
              ->margin(10)
              ->errorCorrection('H')
              ->generate( $menuurl ); 
   
       !!}
       
@endif



</div>


@endsection ('main')