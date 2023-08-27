@extends('layouts.printpage')



@section ('main')
<div class="printQR">
       <form action="">
              <label for="">Стиль</label>
              <select name="" id="">
                     <option value="">Квадрати</option>
                     <option value="">Точки</option>
              </select>
              <label for="">Розмір</label>
              <select name="user_profile_color_1">
                     <option value="900">900</option>
                     <option value="700">700</option>
                     <option value="500">500</option>
                     <option value="300">300</option>
                     <option value="200">200</option>
                     <option value="6">Черный</option>
              </select>

              <label for="">Колір точок:</label>
              <select name="" id="">
                     <option value="">Квадрати</option>
                     <option value="">Точки</option>
              </select>
              <label for="">Колір фону:</label>
              <select name="" id="">
                     <option value="">Квадрати</option>
                     <option value="">Точки</option>
              </select>
              <label for="">Градієнт між 2 кольорами:</label>
              <select name="" id="">
                     <option value="">Квадрати</option>
                     <option value="">Точки</option>
              </select>
              <p>
                     - format: png/svg
                     - size: 200-600px;
                     -color
                     -bg color
                     -gradient
                     - style: square/dot

              </p>
       </form>
	<h1>{{ $place->name }}</h1>
	<h2>Меню:</h2>
	{!! 
        
     QrCode::size(400)
        ->style('dot')
              ->eye('circle')
 //           ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
              ->gradient(255, 0, 0, 0, 0, 255, 'diagonal')
              ->margin(1)
              ->generate( url()->previous() ); 
    !!}




</div>


@endsection ('main')