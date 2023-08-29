@extends('layouts.printpage')



@section ('main')
<div class="printQR">
       <form action="{{  route('printQRstyle', $place) }}" method="POST">
              @csrf
              
              <input type="hidden" name="menuurl" value="{{ $menuurl }}">
              <input type="radio" id="contactChoice1" name="stlqr" value="square" checked />
              <label for="contactChoice1">Квадрати</label>

              <input type="radio" id="contactChoice2" name="stlqr" value="dot" />
              <label for="contactChoice2">Точки</label>

    
<br>
             
              <label for="">Розмір</label>
              <select name="qrsize">
                     <option value="500">500</option>
                     <option value="900">900</option>
                     <option value="700">700</option>
                     
                     <option value="300">300</option>
                     <option value="200">200</option>
                     
              </select>



      <p>Кольори QR кода:</p>
<div>
  <input type="color" id="head" name="qrcolor" value="#e66465" />
  <label for="head">Точки</label>
</div>

<div>
  <input type="color" id="body" name="qrbg" value="#ffffff" />
  <label for="body">Фон</label>
</div>



<br>
<br>

<label for="grad_checkbox">QR код з градієнтом:</label>
<input id="grad_checkbox" type="checkbox" name="grad" value="1">

<div>
  <input type="color" id="head" name="grad_col_1" value="#e66465" />
  <label for="head">Колір 1</label>
</div>

<div>
  <input type="color" id="body" name="grad_col_2" value="#f6b73c" />
  <label for="body">Колір 2</label>
</div>



              <p>
                     - format: png/svg
                     - size: 200-600px;
                     -color
                     -bg color
                     -gradient
                     - style: square/dot
                     -margin

              </p>
              <button type="submit">Submit</button>
       </form>
	<h1>{{ $place->name }}</h1>
	<h2>Меню:</h2>











        
       
       {!!
       //$from = $qrstyle->grad_col_1;
       //$to = $qrstyle->grad_col_2;


       QrCode::size($qrstyle->qrsize)
              //->style('dot')
              ->style($qrstyle->stlqr)
              ->eye('circle')
              ->backgroundColor($qrstyle->qrbg[0], $qrstyle->qrbg[1], $qrstyle->qrbg[2])
            ->gradient($qrstyle->grad_col_1[0], $qrstyle->grad_col_1[1], $qrstyle->grad_col_1[2], $qrstyle->grad_col_2[0], $qrstyle->grad_col_2[1], $qrstyle->grad_col_2[2], 'diagonal')
 //             ->gradient(255, 0, 0, 0, 0, 255, 'diagonal')
              ->margin(10)
              ->errorCorrection('H')
              ->generate( $menuurl ); 
   
       !!}
       




</div>


@endsection ('main')