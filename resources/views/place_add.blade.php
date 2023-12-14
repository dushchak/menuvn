@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>+ Додати заклад</h1>
	<div class="form__wrapper">

		<form action="{{ route('place.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="form__line">
				<label for="txtName" class="requared_input">Назва закладу</label>
				<input type="text" name="name" id="txtName" class="form-control " placeholder="Кафе Міраж" 
				value="{{ old('name') }}">
			</div>
			<div class="form__line">
				<label for="adress" class="requared_input">Адреса</label>
				<input type="text" name="adress" id="adress" class="form-control " placeholder="Соборна, 75"
				value="{{ old('adress') }}">
			</div>
			<div class="form__line">
				<label for="WorkHours" class="requared_input">Розклад</label>
				<input type="text" name="workhours" id="WorkHours" class="form-control " placeholder="12-22"
				value="{{ old('workhours') }}">
			</div>
			<div class="form__line">
				<label for="txtDesc" class="requared_input">Про заклад</label>
				<textarea  name="description" id="txtDesc"  
				placeholder = "Затишне кафе з смачними стравами, гарною атмосферою, привітним сервісом і красивим літнім майданчиком"
				>{{ old('description') }}</textarea>
			</div>
			<!--  -->

			<div class="form__line">
				<label for="Manager" class="requared_input">Контакти керуючого</label>
				<input type="text" name="manager" id="Manager" class="form-control " placeholder="(068) 777-77-77"
				value="{{ old('manager') }}">
			</div>
			

			<!--  -->
			<div class="form__line">
				<label for="txtViber" class="requared_input">Viber</label>
				<input type="text" name="viber" id="txtName" class="form-control " placeholder="(068) 777-77-77"
				value="{{ old('viber') }}">
			</div>
			<div class="form__line">
				<label for="txtTelegram" class="requared_input">Telegram</label>
				<input type="text" name="telegram" id="txtName" class="form-control" placeholder="068-777-77-77"
				value="{{ old('telegram') }}">
			</div>
			<div class="form__line">
				<label for="txtEmail">Email</label>
				<input type="text" name="email" id="txtName" class="form-control" placeholder="manager@mirage.ua"
				value="{{ old('email') }}">
			</div>

			<!--  -->

			<div class="form__line">
				<label for="SitPlaces">Скільки клієнтських місць?</label>
				<input type="text" name="sitplaces" id="SitPlaces" class="form-control " placeholder="35"
				value="{{ old('sitplaces') }}">
			</div>
			<div class="form__line">
				<label for="Delivery">Доставка</label>
				<input type="text" name="delivery" id="Delivery" class="form-control " placeholder="Доставка кур'єрськими службами"
				value="{{ old('delivery') }}">
			</div>
			<div class="form__line">
				<label for="wifi">Пароль Wi-Fi</label>
				<input type="text" name="wifipass" id="wifi" class="form-control" placeholder="wifipass789"
				value="{{ old('wifipass') }}">
			</div>

			


			<!--  -->
			<div class="form__line">
				<label for="phone1" class="requared_input">Телефон Основний</label>
				<input type="text" name="phone1" id="phone1" class="form-control "  placeholder="(068) 379-79-11">
			</div>
			<div class="form__line">
				<label for="phone2">Телефон 2</label>
				<input type="text" name="phone2" id="phone2" class="form-control" placeholder="(068) 379-79-22">
			</div>
			<div class="form__line">
				<label for="phone3">Телефон 3</label>
				<input type="text" name="phone3" id="phone3" class="form-control"  placeholder="(068) 379-79-33">
			</div>
			<div class="form__line">
				<label for="phone4">Телефон 4</label>
				<input type="text" name="phone4" id="phone4" class="form-control"  placeholder="(068) 379-79-44">
			</div>
			
			
			<div class="form__line">
				<label for="txtInsta">Instagram сторінка</label>
				<input type="text" name="insta" id="txtName" class="form-control" placeholder="www.instagram.com/miragekafe4page">
			</div>
			<div class="form__line">
				<label for="txtFb">Facebook сторінка</label>
				<input type="text" name="facebook" id="txtName" class="form-control" placeholder="www.facebook.com/id_company">
			</div>

			<div class="form__line">
				<label  >ФОТО закладу <br> (jpg, png, <2mb)</label>
				<br>
				<input type="file" name="image_file">
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