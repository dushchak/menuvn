@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Додати Акційне оголошення</h1>
	<div class="form__wrapper">
<form action="{{ route('newads.save') }}" method="POST" enctype="multipart/form-data" >
	@csrf

	<!-- <input type="hidden" id="postId" name="place_id" value="{{$place->id}}" /> -->
	<input type="hidden" id="postId" name="place_id" value="{{$place->id}}" /> 


	<div class="form__line">
		<label for="txtName">Заголовок оголошення</label>
		@if($errors->has('title'))
			<input type="text" name="title" id="txtName" class="form-control error_field" placeholder="Друга піцца -50%" value="{{  old('title') }}">
		@else
			<input type="text" name="title" id="txtName" class="form-control" placeholder="Друга піцца -50%" value="{{  old('title') }}">
		@endif
		
	</div>
	<div class="field_error">
		<ul>
			@foreach($errors->get('title') as $message)
				<li>{{ $message }}</li>
			@endforeach
		</ul>
	</div>


	
	<div class="form__line">
		<label for="txtDesc">Тут ваш Промо текст</label>
		@if($errors->has('description'))
			<textarea id="txtDesc" name="description" rows="5" cols="60" placeholder="Кожна друга піцца зі знижкою -50%" class="error_field">{{  old('title') }}</textarea>
		@else
			<textarea id="txtDesc" name="description" rows="5" cols="60" placeholder="Кожна друга піцца зі знижкою -50%">{{  old('description') }}</textarea>
		@endif
	</div>
	<div class="field_error">
		<ul>
			@foreach($errors->get('description') as $message)
				<li>{{ $message }}</li>
			@endforeach
		</ul>
	</div>



	<div class="form__line">
		<label>Зображення <br> (jpg, png, <2mb)</label>
		<br>
		<input type="file" name="image_file" value="{{  old('image_file') }}">
	</div>

	<div class="form__line">
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
	</div><!-- end .form__wrapper -->

</div>

@endsection