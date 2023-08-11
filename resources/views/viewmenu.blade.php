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
        


    </tr>
    @endforeach
</table>
@endif
@endsection('main')
