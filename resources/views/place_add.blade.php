@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
<form action="{{ route('place.store') }}" method="POST">
	@csrf
	<div class="form-group">
		<label for="txtName">Назва закладу</label>
		<input type="text" name="name" id="txtName" class="form-control">
	</div>
	<div class="form-group">
		<label for="txtAdress">Адреса</label>
		<input type="text" name="adress" id="txtName" class="form-control">
	</div>
	<div class="form-group">
		<label for="txtWorkHours">Розклад</label>
		<input type="text" name="workhours" id="txtName" class="form-control">
	</div>
	<div class="form-group">
		<label for="txtDesc">Про заклад</label>
		<input type="text" name="description" id="txtName" class="form-control">
	</div>
	<!--  -->

	<div class="form-group">
		<label for="txtSitPlaces">Скільки клієнтських місць?</label>
		<input type="text" name="sitplaces" id="txtName" class="form-control">
	</div>
	<div class="form-group">
		<label for="txtDelivery">Доставка</label>
		<input type="text" name="delivery" id="txtName" class="form-control">
	</div>
	<div class="form-group">
		<label for="txtManager">Контакти керуючого</label>
		<input type="text" name="manager" id="txtName" class="form-control">
	</div>
	


	<!--  -->
	<div class="form-group">
		<label for="txtPhone2">Телефон 1</label>
		<input type="text" name="phone1" id="txtName" class="form-control" value=" ">
	</div>
	<div class="form-group">
		<label for="txtPhone3">Телефон 2</label>
		<input type="text" name="phone2" id="txtName" class="form-control" value=" ">
	</div>
	<div class="form-group">
		<label for="txtPhone4">Телефон 3</label>
		<input type="text" name="phone3" id="txtName" class="form-control" value=" ">
	</div>
	<div class="form-group">
		<label for="txtEmail">Телефон 4</label>
		<input type="text" name="phone4" id="txtName" class="form-control" value=" ">
	</div>

	<!--  -->
	<div class="form-group">
		<label for="txtViber">Viber</label>
		<input type="text" name="viber" id="txtName" class="form-control" value=" ">
	</div>
	<div class="form-group">
		<label for="txtTelegram">Telegram</label>
		<input type="text" name="telegram" id="txtName" class="form-control" value=" ">
	</div>
	<div class="form-group">
		<label for="txtInsta">Instagram</label>
		<input type="text" name="insta" id="txtName" class="form-control" value=" ">
	</div>
	<div class="form-group">
		<label for="txtFb">Facebook</label>
		<input type="text" name="facebook" id="txtName" class="form-control" value=" ">
	</div>

	<input type="submit" class="btn btn-primary" value="Додати">
</form>
</div>

@endsection