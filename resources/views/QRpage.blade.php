@extends('layouts.printpage')



@section ('main')
<div class="printQR">
	<h1>Кафе Диканька</h1>
	<h2>Меню:</h2>
	{!! 
        
     QrCode::size(400)
 //       ->style('dot')
        ->eye('circle')
 //       ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
        ->gradient(255, 0, 0, 0, 0, 255, 'diagonal')
        ->margin(1)
        ->generate( url()->previous() ); 
    !!}




</div>


@endsection ('main')