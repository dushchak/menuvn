@extends('layouts.base')



@section ('main')
@if(count ($places) > 0)
<table class="table table-striped">
    @foreach ($places as $place)
    <tr>
        <td><img class="dish__image" src="/storage/images/places/{{$place->thumbnail}}" alt=""></td>
        <td>{{ $place->name }}</td>
        <td>{{ $place->adress }}</td>
        <td>{{ $place->workhours }}</td>
        <td>{{ $place->sitplaces }}</td>
        <td>{{ $place->delivery }}</td>
        <td>{{ $place->manager }}</td>
        <td>{{ $place->phone1 }}</td>
        <td>{{ $place->viber }}</td>
        <td><a href="">edit</a></td>
        <td><a href="">Відключити</a></td>
        <td><a href="{{ route('dish.add', $place->id)    }}">new dish</a></td>
        <td><a href="{{ route('viewMenu', $place->id) }}">view menu</a></td>

    </tr>
    @endforeach
</table>
@endif
@endsection('main')
