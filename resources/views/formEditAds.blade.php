

@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Редагувати оголошення</h1>
	<div class="form__wrapper">
		<form action="{{ route('ads.update', $ads) }}" method="POST" enctype="multipart/form-data" >
			@csrf

			<input type="hidden" id="postId" name="place_id" value="{{$ads->id}}" />


			<div class="form__line">
				<label for="txtName">Заголовок оголошення</label>
				<input type="text" name="title" id="txtName" class="form-control" value="{{$ads->title}}" placeholder="Акція 3+1">
			</div>
			
			<div class="form__line">
				<label for="txtDesc">Опис пропозиції</label>
				<textarea id="txtDesc" name="description" rows="5" cols="60" placeholder="Кожна четверта піцца в подарунок">{{$ads->description}}</textarea>
			</div>

			<div class="form__line">
				<img class="dish__image" src="/storage/images/ads/{{$ads->img}}" alt="">
			</div>

			<div class="form__line">
				<label>Зображення (jpg, png, <2mb)</label>
				<br>
				<input type="file" name="image_file" value="{{$ads->img}}">
			</div>

			<div class="form__line">
				<input type="submit" class="btn btn-primary" value="Зберегти">
			</div>
		</form>
	</div>

	 <a class="btn_m" href="{{ route('ads.delete', $ads)}}">Видалити оголошення</a>

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