@extends('layouts.base')

@section('title')

@section('main')
<div class="menu">

	<table class="table table-striped">
		<td><img class="dish__image" src="/storage/images/dishes/{{$dish->thumbnail}}" alt=""></td>
        <td>{{ $dish->dishtitle }}</td>
        <td>{{ $dish->dishgroup }}</td>
        <td>{{ $dish->description }}</td>
        <td>{{ $dish->portionweight }}</td>
        <td>{{ $dish->portioncost }}</td>
        <td>{{ $dish->cost100g }}</td>
	</table>
</div>


<form action="{{ route('dish.delete', ['dish'=>$dish->id])   }}" method="POST">
	@csrf
	@method('DELETE')

	<input type="submit" class="btn btn-danger" value="Видалити">
</form>

@endsection('main')