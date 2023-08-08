@extends('layouts.base')



@section ('main')
@if(count ($places) > 0)
<table class="table table-striped">
    @foreach ($places as $place)
    <tr>
        <td>{{ $place->name }}</td>
        <td>{{ $place->adress }}</td>
        <td>{{ $place->workhours }}</td>
        <td>{{ $place->sitplaces }}</td>
        <td>{{ $place->delivery }}</td>
        <td>{{ $place->manager }}</td>
        <td>{{ $place->phone1 }}</td>
        <td>{{ $place->viber }}</td>
        <td><a href="">edit</a></td>
        <td><a href="">delete</a></td>
    </tr>
    @endforeach
</table>
@endif
@endsection('main')
