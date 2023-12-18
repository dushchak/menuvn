@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>+ Додати заклад</h1>
	<div class="form__wrapper">

		<form action="{{ route('place.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<!-- name -->
			<div class="form__line">
				<label for="txtName" class="requared_input">Назва закладу</label>
				@if($errors->has('name'))
					<input type="text" name="name" id="txtName" 
					class="form-control error_field" 
					placeholder="Кафе Міраж" value="{{ old('name') }} ">
				@else
					<input type="text" name="name" id="txtName" 
					class="form-control" 
					placeholder="Кафе Міраж" value="{{ old('name') }} ">
				@endif
	
			</div>
			<div class="inputs_errors">
					<ul>
					@foreach($errors->get('name') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>

			<!-- adress -->
			<div class="form__line">
				<label for="adress" class="requared_input">Адреса</label>
				@if($errors->has('adress'))
					<input type="text" name="adress" id="adress" class="form-control error_field" placeholder="Соборна, 75"
					value="{{ old('adress') }}">
				@else
					<input type="text" name="adress" id="adress" class="form-control " placeholder="Соборна, 75"
					value="{{ old('adress') }}">
				@endif

			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('adress') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>

			<!-- workhours -->
			<div class="form__line">
				<label for="WorkHours" class="">Час роботи</label>
				@if($errors->has('adress'))
					<input type="text" name="workhours" id="WorkHours" class="form-control error_field" placeholder="12-22"
					value="{{ old('workhours') }}">
				@else
					<input type="text" name="workhours" id="WorkHours" class="form-control " placeholder="12-22"
					value="{{ old('workhours') }}">
				@endif
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('workhours') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>

			<!-- description -->
			<div class="form__line">
				<label for="txtDesc" class="requared_input">Про заклад</label>
				@if($errors->has('description'))
					<textarea  name="description" id="txtDesc"  
					placeholder = "Затишне кафе з смачними стравами, гарною атмосферою, привітним сервісом і красивим літнім майданчиком" class="error_field">{{ old('description') }}</textarea>
				@else
					<textarea  name="description" id="txtDesc"  
					placeholder = "Затишне кафе з смачними стравами, гарною атмосферою, привітним сервісом і красивим літнім майданчиком" class="">{{ old('description') }}</textarea>
				@endif	
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('description') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			<!-- maneger -->
			<div class="form__line">
				<label for="Manager" class="requared_input" title="Цей контакт прихований для відвідувачів">Телефон <br> (керуючого)</label>
				@if($errors->has('manager'))
					<input type="text" name="manager" id="Manager" class="form-control error_field" placeholder="(068) 777-77-77"
					value="{{ old('manager') }}">
				@else
					<input type="text" name="manager" id="Manager" class="form-control " placeholder="(068) 777-77-77"
					value="{{ old('manager') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('description') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>
			

			<!-- viber -->
			<div class="form__line">
				<label for="txtViber" class="requared_input" title="Цей контакт прихований для відвідувачів">Viber <br> (керуючого)</label>
				@if($errors->has('viber'))
					<input type="text" name="viber" id="txtName" class="form-control error_field" placeholder="(068) 777-77-77"
					value="{{ old('viber') }}">
				@else
					<input type="text" name="viber" id="txtName" class="form-control " placeholder="(068) 777-77-77"
					value="{{ old('viber') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('viber') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			<div class="form__line">
				<label for="txtTelegram" class="" title="Цей контакт прихований для відвідувачів">Telegram <br> (керуючого)</label>
				@if($errors->has('telegram'))
					<input type="text" name="telegram" id="txtName" class="form-control error_field" placeholder="068-777-77-77"
					value="{{ old('telegram') }}">
				@else
					<input type="text" name="telegram" id="txtName" class="form-control" placeholder="068-777-77-77"
					value="{{ old('telegram') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('telegram') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			<div class="form__line">
				<label for="txtEmail" class="requared_input" title="Цей контакт прихований для відвідувачів">Email <br> (керуючого)</label>
				@if($errors->has('manager'))
					<input type="text" name="email" id="txtName" class="form-control error_field" placeholder="manager@mirage.ua"
					value="{{ old('email') }}">
				@else
					<input type="text" name="email" id="txtName" class="form-control" placeholder="manager@mirage.ua"
					value="{{ old('email') }}">
				@endif		
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('email') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>

			<!--  -->

			<div class="form__line">
				<label for="SitPlaces" title="Скілький посадочних місць у закладі?">Клієнтських місць</label>
				@if($errors->has('sitplaces'))
					<input type="text" name="sitplaces" id="SitPlaces" class="form-control error_field" placeholder="35"
					value="{{ old('sitplaces') }}">
				@else
					<input type="text" name="sitplaces" id="SitPlaces" class="form-control " placeholder="35"
					value="{{ old('sitplaces') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('sitplaces') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>



			<div class="form__line">
				<label for="Delivery" title="Коротко про способи доставки">Доставка</label>
				@if($errors->has('delivery'))
					<input type="text" name="delivery" id="Delivery" class="form-control error_field" placeholder="Доставка кур'єрськими службами"
					value="{{ old('delivery') }}">
				@else
					<input type="text" name="delivery" id="Delivery" class="form-control " placeholder="Доставка кур'єрськими службами"
					value="{{ old('delivery') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('delivery') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			<div class="form__line">
				<label for="wifi" title="WiFi пароль в закладі">Пароль Wi-Fi</label>
				@if($errors->has('wifipass'))
					<input type="text" name="wifipass" id="wifi" class="form-control error_field" placeholder="wifipass789"
				value="{{ old('wifipass') }}">
				@else
					<input type="text" name="wifipass" id="wifi" class="form-control" placeholder="wifipass789"
				value="{{ old('wifipass') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('wifipass') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>

			


			<!--  -->
			<div class="form__line">
				<label for="phone1" class="requared_input" title="Телефон для замовлень">Телефон основний <br> (для замовлень)</label>
				@if($errors->has('phone1'))
					<input type="text" name="phone1" id="phone1" class="form-control error_field"  placeholder="(068) 379-79-11" 
					value="{{ old('phone1') }}">
				@else
					<input type="text" name="phone1" id="phone1" class="form-control "  placeholder="(068) 379-79-11" 
					value="{{ old('phone1') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('phone1') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			<div class="form__line">
				<label for="phone2" title="Телефон для замовлень">Телефон 2 </label>
				@if($errors->has('phone2'))
					<input type="text" name="phone2" id="phone2" class="form-control error_field" placeholder="(068) 379-79-22"
				value="{{ old('phone2') }}">
				@else
					<input type="text" name="phone2" id="phone2" class="form-control" placeholder="(068) 379-79-22"
				value="{{ old('phone2') }}">
				@endif
			
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('phone2') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			<div class="form__line">
				<label for="phone3" title="Телефон для замовлень">Телефон 3</label>
				@if($errors->has('phone3'))
					<input type="text" name="phone3" id="phone3" class="form-control error_field"  placeholder="(068) 379-79-33"
					value="{{ old('phone3') }}">
				@else
					<input type="text" name="phone3" id="phone3" class="form-control"  placeholder="(068) 379-79-33"
					value="{{ old('phone3') }}">
				@endif
			
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('phone3') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			<div class="form__line">
				<label for="phone4" title="Телефон для замовлень">Телефон 4</label>
				@if($errors->has('phone4'))
					<input type="text" name="phone4" id="phone4" class="form-control error_field"  placeholder="(068) 379-79-44"
				value="{{ old('phone4') }}">
				@else
					<input type="text" name="phone4" id="phone4" class="form-control"  placeholder="(068) 379-79-44"
				value="{{ old('phone4') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('phone4') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			
			
			<div class="form__line">
				<label for="txtInsta">Instagram сторінка</label>
				@if($errors->has('insta'))
				<input type="text" name="insta" id="txtName" class="form-control error_field" placeholder="www.instagram.com/miragekafe4page" value="{{ old('insta') }}">
				@else
				<input type="text" name="insta" id="txtName" class="form-control" placeholder="www.instagram.com/miragekafe4page" value="{{ old('insta') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('insta') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>


			<div class="form__line">
				<label for="txtFb">Facebook сторінка</label>
				@if($errors->has('facebook'))
				<input type="text" name="facebook" id="txtName" class="form-control error_field" placeholder="www.facebook.com/id_company" value="{{ old('facebook') }}">
				@else
				<input type="text" name="facebook" id="txtName" class="form-control" placeholder="www.facebook.com/id_company" value="{{ old('facebook') }}">
				@endif
				
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('facebook') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>



			<div class="form__line">
				<label  >ФОТО закладу <br> (jpg, png, <2mb)</label>
				<br>
				<input type="file" name="image_file">
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




</div>

@endsection