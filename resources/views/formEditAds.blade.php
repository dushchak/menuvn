

@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Редагувати оголошення</h1>
	<form action="{{ route('ads.update', $ads) }}" method="POST" enctype="multipart/form-data" >
		@csrf

		<input type="hidden" id="postId" name="place_id" value="{{$ads->id}}" />


		<div class="form-group">
			<label for="txtName">*Заголовок оголошення</label>
			<input type="text" name="title" id="txtName" class="form-control" value="{{$ads->title}}">
		</div>
		
		<div class="form-group">
			<label for="txtDesc">*Тут ваш Промо текст</label>
			<textarea id="txtDesc" name="description" rows="5" cols="60">
				{{$ads->description}}
			</textarea>
		</div>

		<div class="form-group">
			<select name="typeads" value="{{$ads->typeads}}">
				<!--Supplement an id here instead of using 'name'-->
				<option value="1">Банер</option>
				<option value="2">Текст і зображення</option>
			</select>
		</div>

		<img class="dish__image" src="/storage/images/ads/{{$ads->img}}" alt="">

		<div class="form-group">
			<label>Зображення 300х100px або 100х100</label>
			<br>
			<input type="file" name="image_file" value="{{$ads->img}}">
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Додати">
		</div>
	</form>

	 <a href="{{ route('ads.delete', $ads)}}">deleteAds</a>

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


@endsection('main')