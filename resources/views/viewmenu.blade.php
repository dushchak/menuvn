@extends('layouts.base')



@section ('main')
<div class="newdish">
    <a href="">new dish</a>
</div>
@if(count ($menu) > 0)
<table class="table table-striped">
    @foreach ($menu as $dish)
    <tr>
        <td>image</td>
        <td>{{ $dish->dishtitle }}</td>
        <td>{{ $dish->dishgroup }}</td>
        <td>{{ $dish->description }}</td>
        <td>{{ $dish->portionweight }}</td>
        <td>{{ $dish->portioncost }}</td>
        <td>{{ $dish->cost100g }}</td>
        <td><a href="">edit dish</a></td>
        <td><a href="">delete dish</a></td>
        <td><a href="">Повідомити про помилку</a></td>
        


    </tr>
    @endforeach
</table>
@endif
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
    
</div>
@endsection('main')
