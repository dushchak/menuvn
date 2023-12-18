@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>+ Додати страву</h1>
	<h2>Меню {{$place->name}}</h2>
	<div class="form__wrapper">
		<form class="form" action="{{ route('dish.save') }}" method="POST" enctype="multipart/form-data" >
			@csrf

			<input type="hidden" id="postId" name="place_id" value="{{$place->id}}" />


			<div class="form__line">
				<label for="txtName">Назва страви</label>
				@if($errors->has('dish_title'))
					<input type="text" name="dish_title" id="txtName" class="form-control error_field" placeholder="Піцца" value="{{ old('dish_title') }}">
				@else
					<input type="text" name="dish_title" id="txtName" class="form-control" placeholder="Піцца" value="{{ old('dish_title') }}">
				@endif
			
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('dish_title') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>



			<div class="form__line">
				<label for="dish_group">Розділ</label>
				<select name="dish_group" id="dish_group" value="{{ old('dish_group') }}">
					<!--Supplement an id here instead of using 'name'-->
					<option value="1" selected>Основне меню</option>
					<option value="2">Холодні закуски</option>
					<option value="3">Гарячі закуски</option>
					<option value="4">Перші страви</option>
					<option value="5">Гарніри</option>
					<option value="6">Салати</option>
					<option value="7">Десерт</option>
					<option value="8">Гарячі напої</option>
					<option value="9">Холодні напої</option>
					<option value="10">Пиво</option>
					<option value="11">Вино</option>
					<option value="12">Міцні напої</option>
					<option value="13">Алкогольні напої</option>
					<option value="14">Коктейлі</option>
				</select>
			</div>
			
			<div class="form__line">
				<label for="txtDesc">Про страву - склад, пропорції, опис та особливості приготування, ітп</label>
				@if($errors->has('description'))
					<textarea id="txtDesc" name="description" rows="5" cols="60" placeholder="20/50/30 Сметана/Дируни/Соус" class="error_field">
					{{ old('description') }}
				</textarea>
				@else
					<textarea id="txtDesc" name="description" rows="5" cols="60" placeholder="20/50/30 Сметана/Дируни/Соус">{{ old('description') }}</textarea>
				@endif
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('description') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			<!--  -->
			<div class="form__line">
				<label for="txtSitPlaces">Вага 1 порції, Грамм</label>
				@if($errors->has('portionweight'))
					<input type="text" name="portionweight" id="txtName" class="form-control error_field" placeholder="480" value="{{ old('portionweight') }}">
				@else
					<input type="text" name="portionweight" id="txtName" class="form-control" placeholder="480" value="{{ old('portionweight') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('portionweight') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>



			<div class="form__line">
				<label for="txtDelivery">Ціна 1 порції, Грн</label>
				@if($errors->has('portioncost'))
					<input type="text" name="portioncost" id="txtName" class="form-control error_field" placeholder="185" value="{{ old('portioncost') }}">
				@else
					<input type="text" name="portioncost" id="txtName" class="form-control" placeholder="185" value="{{ old('portioncost') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('portioncost') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>



			<div class="form__line">
				<label  >Фото страви (jpg,png, <2мб)</label>
				<br>
				<input type="file" name="image_file" value="{{ old('image_file') }}">
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('image_file') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>



			<div class="form__line">
				<input type="submit" class="form__button" value="Додати">
			</div>
		</form>
	</div>
	
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