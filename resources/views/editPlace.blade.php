@extends('layouts.base')

@section('title','Редагування закладу')

@section('main')
<div class="container">
	<h1>Редагувати заклад</h1>
	<div class="form__wrapper">
		<form action="{{ route('place.update', ['placeid'=>$place->id]) }}" method="POST" >
			@csrf
			@method('PATCH')


			<div class="form__line">
				<label for="txtName">Назва закладу</label>
				<input type="text" name="name" id="txtName" class="form-control" value="{{ $place->name  }}" placeholder="Кафе Новорічне">
			</div>
			<div class="form__line">
				<label for="txtAdress">Адреса</label>
				<input type="text" name="adress" id="txtName" class="form-control" value="{{ $place->adress  }}" placeholder="Соборна 77">
			</div>
			<div class="form__line">
				<label for="txtWorkHours">Розклад</label>
				<input type="text" name="workhours" id="txtName" class="form-control" value="{{ $place->workhours  }}" placeholder="9-22">
			</div>
			<div class="form__line">
				<label for="txtDesc">Про заклад</label>
				<input type="text" name="description" id="txtName" class="form-control" value="{{ $place->description  }}" placeholder="Смачні страви, святкова зала і привітний персонал ">
			</div>
			<!--  -->

			<div class="form__line">
				<label for="txtSitPlaces">Скільки клієнтських місць?</label>
				<input type="text" name="sitplaces" id="txtName" class="form-control" value="{{ $place->sitplaces  }}" placeholder="35">
			</div>
			<div class="form__line">
				<label for="txtDelivery">Доставка</label>
				<input type="text" name="delivery" id="txtName" class="form-control" value="{{ $place->delivery  }}" placeholder="Доставка кур'єрськими службами">
			</div>
			<div class="form__line">
				<label for="txtDelivery">Пароль Wi-Fi</label>
				<input type="text" name="wifipass" id="txtName" class="form-control" placeholder="pass_wifi135">
			</div>
			<br>
			<p class="manager_highlight">Контакти менеджера:</p>
			<div class="form__line">
				<label for="txtManager" class="manager_highlight">Контакти керуючого</label>
				<input type="text" name="manager" id="txtName" class="form-control" value="{{ $place->manager  }}" placeholder="067-777-77-77">
			</div>
			<div class="form__line">
				<label for="txtEmail" class="manager_highlight">Email</label>
				<input type="text" name="email" id="txtName" class="form-control"  value="{{ $place->phone4  }}" placeholder="hello@kafe.ua">
			</div>
			<div class="form__line">
				<label for="txtViber" class="manager_highlight">Viber</label>
				<input type="text" name="viber" id="txtName" class="form-control" value="{{ $place->viber  }}" placeholder="067-777-77-77">
			</div>
			<div class="form__line">
				<label for="txtTelegram" manager_highlight>Telegram</label>
				<input type="text" name="telegram" id="txtName" class="form-control" value="{{ $place->telegram  }}" placeholder="067-777-77-77">
			</div>
			<br>


			<!--  -->
			<div class="form__line">
				<label for="txtPhone2">Телефон 1</label>
				<input type="text" name="phone1" id="txtName" class="form-control"  value="{{ $place->phone1  }}" placeholder="067-777-77-77">
			</div>
			<div class="form__line">
				<label for="txtPhone3">Телефон 2</label>
				<input type="text" name="phone2" id="txtName" class="form-control" value="{{ $place->phone2  }}" placeholder="067-777-77-77">
			</div>
			<div class="form__line">
				<label for="txtPhone4">Телефон 3</label>
				<input type="text" name="phone3" id="txtName" class="form-control" value="{{ $place->phone3  }}" placeholder="067-777-77-77">
			</div>
			<div class="form__line">
				<label for="txtEmail">Телефон 4</label>
				<input type="text" name="phone4" id="txtName" class="form-control"  value="{{ $place->phone4  }}" placeholder="067-777-77-77">
			</div>

			<!--  -->

			<div class="form__line">
				<label for="txtInsta">Instagram</label>
				<input type="text" name="insta" id="txtName" class="form-control" value="{{ $place->insta  }}" placeholder="@kafename">
			</div>
			<div class="form__line">
				<label for="txtFb">Facebook</label>
				<input type="text" name="fb" id="txtName" class="form-control"  value="{{ $place->facebook  }}" placeholder="www.facebook.com/kafe">
			</div>
			<div>
				<label for="">Видимість: </label>
				<input type="radio" id="contactChoice1" name="disabled" value="0" checked />
		      <label for="contactChoice1">Включити</label>

		      <input type="radio" id="contactChoice2" name="disabled" value="1" />
		      <label for="contactChoice2">Відключити заклад</label>
		    	
		  </div>
		  	<div class="form__line">
				<input type="submit" class="btn btn-primary" value="Додати">
			</div>
		</form>
	</div>

<div class="changeImage">
	<h3>Змінити зображення</h3>
	<div class="form__wrapper">
		<img class="dish__image" src="/storage/images/places/{{$place->thumbnail}}" alt="">
		<form action="{{ route('place.updateImage', ['placeid'=>$place->id]) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PATCH')


		<input type="hidden" name="thumbnail" value="{{$place->thumbnail}}">
		<div class="form__line">
			<label  >Фото (jpg, png, <2mb)</label>
			<br>
			<input type="file" name="image_file">
		</div>
		<div class="form__line">
			<input type="submit" class="btn btn-primary" value="Завантажити">
		</div>
		</form>
	</div>

	<div class="button">
		<a class="btn_m" href="{{ route('place.deleteImage', ['placeid'=>$place->id]) }}">Видалити зображення</a>
	</div>
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