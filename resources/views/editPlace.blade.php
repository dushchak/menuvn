@extends('layouts.base')

@section('title','Редагування закладу')

@section('main')
<div class="container">
	<h1>Редагувати заклад</h1>
	<div class="form__wrapper">
		<form action="{{ route('place.update', ['placeid'=>$place->id]) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PATCH')


			<div class="form__line">
				<label for="txtName">Назва закладу</label>
				@if($errors->has('name'))
					<input type="text" name="name" id="txtName" class="form-control error_field" value="{{ $place->name  }}" placeholder="Кафе Новорічне" >
				@else
					<input type="text" name="name" id="txtName" class="form-control" value="{{ $place->name  }}" placeholder="Кафе Новорічне" >
				@endif
			</div>
			<div class="field_error">
				<ul>
					@foreach($errors->get('name') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>


			<div class="form__line">
				<label for="txtAdress">Адреса</label>
				@if($errors->has('adress'))
					<input type="text" name="adress" id="txtName" class="form-control error_field" value="{{ $place->adress  }}" placeholder="Соборна 77">
				@else
					<input type="text" name="adress" id="txtName" class="form-control" value="{{ $place->adress  }}" placeholder="Соборна 77">
				@endif
				
			</div>
			<div class="field_error">
				<ul>
					@foreach($errors->get('adress') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>


			<div class="form__line">
				<label for="txtWorkHours">Розклад</label>
				@if($errors->has('workhours'))
					<input type="text" name="workhours" id="txtName" class="form-control error_field" value="{{ $place->workhours  }}" placeholder="9-22">
				@else
					<input type="text" name="workhours" id="txtName" class="form-control" value="{{ $place->workhours  }}" placeholder="9-22">
				@endif
				
			</div>
			<div class="field_error">
				<ul>
					@foreach($errors->get('workhours') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>


			<div class="form__line">
				<label for="txtDesc">Про заклад</label>
				@if($errors->has('description'))
					<textarea type="text" name="description" id="txtName" class="form-control error_field" value="" placeholder="Смачні страви, святкова зала і привітний персонал " rows="5" cols="60">{{ $place->description  }}</textarea>
				@else
					<textarea type="text" name="description" id="txtName" class="form-control" value="" placeholder="Смачні страви, святкова зала і привітний персонал " rows="5" cols="60">{{ $place->description  }}</textarea>
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
				<label for="txtSitPlaces">Скільки клієнтських місць?</label>
				@if($errors->has('sitplaces'))
					<input type="text" name="sitplaces" id="txtName" class="form-control error_field" value="{{ $place->sitplaces  }}" placeholder="35">
				@else
					<input type="text" name="sitplaces" id="txtName" class="form-control" value="{{ $place->sitplaces  }}" placeholder="35">
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
				<label for="txtDelivery">Доставка</label>
				@if($errors->has('delivery'))
					<input type="text" name="delivery" id="txtName" class="form-control error_field" value="{{ $place->delivery  }}" placeholder="Доставка кур'єрськими службами">
				@else
					<input type="text" name="delivery" id="txtName" class="form-control" value="{{ $place->delivery  }}" placeholder="Доставка кур'єрськими службами">
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
				<label for="txtDelivery">Пароль Wi-Fi</label>
				@if($errors->has('wifipass'))
					<input type="text" name="wifipass" id="txtName" class="form-control error_field" placeholder="pass_wifi135">
				@else
					<input type="text" name="wifipass" id="txtName" class="form-control" placeholder="pass_wifi135">
				@endif
				
			</div>
			<div class="field_error">
				<ul>
					@foreach($errors->get('wifipass') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>



			<br>
			<p class="manager_highlight">Контакти менеджера:</p>
			<div class="form__line">
				<label for="txtManager" class="manager_highlight">Контакти керуючого</label>
				@if($errors->has('manager'))
					<input type="text" name="manager" id="txtName" class="form-control error_field" value="{{ $place->manager  }}" placeholder="067-777-77-77">
				@else
					<input type="text" name="manager" id="txtName" class="form-control" value="{{ $place->manager  }}" placeholder="067-777-77-77">
				@endif
				
			</div>
			<div class="field_error">
				<ul>
					@foreach($errors->get('manager') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>


			<div class="form__line">
				<label for="txtEmail" class="manager_highlight">Email</label>
				@if($errors->has('email'))
					<input type="text" name="email" id="txtName" class="form-control error_field"  value="{{ $place->phone4  }}" placeholder="hello@kafe.ua">
				@else
					<input type="text" name="email" id="txtName" class="form-control"  value="{{ $place->phone4  }}" placeholder="hello@kafe.ua">
				@endif
				
			</div>
			<div class="field_error">
				<ul>
					@foreach($errors->get('email') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>


			<div class="form__line">
				<label for="txtViber" class="manager_highlight">Viber</label>
				@if($errors->has('viber'))
					<input type="text" name="viber" id="txtName" class="form-control error_field" value="{{ $place->viber  }}" placeholder="067-777-77-77">
				@else
					<input type="text" name="viber" id="txtName" class="form-control" value="{{ $place->viber  }}" placeholder="067-777-77-77">
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
				<label for="txtTelegram" manager_highlight>Telegram</label>
				@if($errors->has('telegram'))
					<input type="text" name="telegram" id="txtName" class="form-control error_field" value="{{ $place->telegram  }}" placeholder="067-777-77-77">
				@else
					<input type="text" name="telegram" id="txtName" class="form-control" value="{{ $place->telegram  }}" placeholder="067-777-77-77">
				@endif
				
			</div>
			<div class="field_error">
				<ul>
					@foreach($errors->get('telegram') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>
			<br>


			<!--  -->
			<div class="form__line">
				<label for="txtPhone2">Телефон 1</label>
				@if($errors->has('phone1'))
					<input type="text" name="phone1" id="txtName" class="form-control error_field"  value="{{ $place->phone1  }}" placeholder="067-777-77-77">
				@else
					<input type="text" name="phone1" id="txtName" class="form-control"  value="{{ $place->phone1  }}" placeholder="067-777-77-77">
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
				<label for="txtPhone3">Телефон 2</label>
				@if($errors->has('phone2'))
					<input type="text" name="phone2" id="txtName" class="form-control error_field" value="{{ $place->phone2  }}" placeholder="067-777-77-77">
				@else
					<input type="text" name="phone2" id="txtName" class="form-control" value="{{ $place->phone2  }}" placeholder="067-777-77-77">
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
				<label for="txtPhone4">Телефон 3</label>
				@if($errors->has('phone3'))
					<input type="text" name="phone3" id="txtName" class="form-control error_field" value="{{ $place->phone3  }}" placeholder="067-777-77-77">
				@else
					<input type="text" name="phone3" id="txtName" class="form-control" value="{{ $place->phone3  }}" placeholder="067-777-77-77">
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
				<label for="txtEmail">Телефон 4</label>
				@if($errors->has('phone4'))
					<input type="text" name="phone4" id="txtName" class="form-control error_field"  value="{{ $place->phone4  }}" placeholder="067-777-77-77">
				@else
					<input type="text" name="phone4" id="txtName" class="form-control"  value="{{ $place->phone4  }}" placeholder="067-777-77-77">
				@endif
				
			</div>
			<div class="field_error">
				<ul>
					@foreach($errors->get('phone4') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>



			<!--  -->

			<div class="form__line">
				<label for="txtInsta">Instagram</label>
				@if($errors->has('insta'))
					<input type="text" name="insta" id="txtName" class="form-control error_field" value="{{ $place->insta  }}" placeholder="@kafename">
				@else
					<input type="text" name="insta" id="txtName" class="form-control" value="{{ $place->insta  }}" placeholder="@kafename">
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
				<label for="txtFb">Facebook</label>
				@if($errors->has('fb'))
					<input type="text" name="fb" id="txtName" class="form-control error_field"  value="{{ $place->facebook  }}" placeholder="www.facebook.com/cafe">
				@else
					<input type="text" name="fb" id="txtName" class="form-control"  value="{{ $place->facebook  }}" placeholder="www.facebook.com/cafe">
				@endif
				
			</div>
			<div class="field_error">
				<ul>
					@foreach($errors->get('fb') as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>


		  	<img class="dish__image" src="/storage/images/places/{{$place->thumbnail}}" alt="">



		  	<div class="form__line">
				<label  >Фото (jpg, png, <2mb)</label>
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


			<div>
				<label for="">Видимість в Білому списку: </label>
				<input type="radio" id="contactChoice1" name="disabled" value="0" checked />
		    	<label for="contactChoice1">Включити</label>
		    	або
		      	<label for="contactChoice2">Відключити заклад</label>
		      	<input type="radio" id="contactChoice2" name="disabled" value="1" />
		    </div>



		  	<div class="form__line">
				<input type="submit" class="btn btn-primary" value="Додати">
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