@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Поповнити монети</h1>
<form action="{{ route('coins.add', $place) }}" method="POST" >
	@csrf

	<div class="form-group">
		<label for="addSum">*Сумма монет</label>
		<input type="text" name="addsum" id="addSum" class="form-control">
	</div>
	<div class="form-group">
		<label for="comment">*Comment</label>
		<textarea id="comment" name="comment" rows="3" cols="40">
		</textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Додати">
	</div>
</form>


<div class="valid_errors">
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
</div>

@endsection