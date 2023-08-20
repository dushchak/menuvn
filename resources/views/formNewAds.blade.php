@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Додати Рекламне оголошення</h1>
<form action="{{ route('newads.save') }}" method="POST" enctype="multipart/form-data" >
	@csrf

	<input type="hidden" id="postId" name="place_id" value="{{$place->id}}" />


	<div class="form-group">
		<label for="txtName">*Заголовок оголошення</label>
		<input type="text" name="title" id="txtName" class="form-control">
	</div>
	
	<div class="form-group">
		<label for="txtDesc">*Тут ваш Промо текст</label>
		<textarea id="txtDesc" name="description" rows="5" cols="60">
		</textarea>
	</div>

	<div class="form-group">
		<select name="typeads">
			<!--Supplement an id here instead of using 'name'-->
			<option value="1" selected>Банер</option>
			<option value="2">Текст і зображення</option>
		</select>
	</div>

	<div class="form-group">
		<label>Зображення 300х100px або 100х100</label>
		<br>
		<input type="file" name="image_file">
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