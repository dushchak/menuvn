@extends('layouts.base')

@section('title','Редагування закладу')

@section('main')
<div class="container">
<form action="{{ route('place.update', ['placeid'=>$place->id]) }}" method="POST" >
	@csrf
	@method('PATCH')


	<div class="form-group">
		<label for="txtName">Назва закладу</label>
		<input type="text" name="name" id="txtName" class="form-control" value="{{ $place->name  }}">
	</div>
	<div class="form-group">
		<label for="txtAdress">Адреса</label>
		<input type="text" name="adress" id="txtName" class="form-control" value="{{ $place->adress  }}">
	</div>
	<div class="form-group">
		<label for="txtWorkHours">Розклад</label>
		<input type="text" name="workhours" id="txtName" class="form-control" value="{{ $place->workhours  }}">
	</div>
	<div class="form-group">
		<label for="txtDesc">Про заклад</label>
		<input type="text" name="description" id="txtName" class="form-control" value="{{ $place->description  }}">
	</div>
	<!--  -->

	<div class="form-group">
		<label for="txtSitPlaces">Скільки клієнтських місць?</label>
		<input type="text" name="sitplaces" id="txtName" class="form-control" value="{{ $place->sitplaces  }}">
	</div>
	<div class="form-group">
		<label for="txtDelivery">Доставка</label>
		<input type="text" name="delivery" id="txtName" class="form-control" value="{{ $place->delivery  }}">
	</div>
	<div class="form-group">
		<label for="txtManager">Контакти керуючого</label>
		<input type="text" name="manager" id="txtName" class="form-control" value="{{ $place->manager  }}">
	</div>
	


	<!--  -->
	<div class="form-group">
		<label for="txtPhone2">Телефон 1</label>
		<input type="text" name="phone1" id="txtName" class="form-control"  value="{{ $place->phone1  }}">
	</div>
	<div class="form-group">
		<label for="txtPhone3">Телефон 2</label>
		<input type="text" name="phone2" id="txtName" class="form-control" value="{{ $place->phone2  }}">
	</div>
	<div class="form-group">
		<label for="txtPhone4">Телефон 3</label>
		<input type="text" name="phone3" id="txtName" class="form-control" value="{{ $place->phone3  }}">
	</div>
	<div class="form-group">
		<label for="txtEmail">Телефон 4</label>
		<input type="text" name="phone4" id="txtName" class="form-control"  value="{{ $place->phone4  }}">
	</div>

	<!--  -->
	<div class="form-group">
		<label for="txtViber">Viber</label>
		<input type="text" name="viber" id="txtName" class="form-control" value="{{ $place->viber  }}">
	</div>
	<div class="form-group">
		<label for="txtTelegram">Telegram</label>
		<input type="text" name="telegram" id="txtName" class="form-control" value="{{ $place->telegram  }}">
	</div>
	<div class="form-group">
		<label for="txtInsta">Instagram</label>
		<input type="text" name="insta" id="txtName" class="form-control" value="{{ $place->insta  }}">
	</div>
	<div class="form-group">
		<label for="txtFb">Facebook</label>
		<input type="text" name="facebook" id="txtName" class="form-control"  value="{{ $place->facebook  }}">
	</div>
	<div>
		<input type="radio" id="contactChoice1" name="disabled" value="0" checked />
      <label for="contactChoice1">Включити</label>

      <input type="radio" id="contactChoice2" name="disabled" value="1" />
      <label for="contactChoice2">Відключити заклад</label>
    	
  </div>

	

	<input type="submit" class="btn btn-primary" value="Додати">
</form>

<div class="changeImage">
	<h3>Змінити зображення</h3>
	<img class="dish__image" src="/storage/images/places/{{$place->thumbnail}}" alt="">
	<form action="{{ route('place.updateImage', ['placeid'=>$place->id]) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PATCH')


	<input type="hidden" name="thumbnail" value="{{$place->thumbnail}}">
	<div class="form-group">
		<label  >Thumbnail</label>
		<br>
		<input type="file" name="image_file">
	</div>
	<div class="button">
		<input type="submit" class="btn btn-primary" value="Завантажити">
	</div>
	</form>
	<div class="button">
		<a class="btn btn-primary" href="{{ route('place.deleteImage', ['placeid'=>$place->id]) }}">Видалити зображення</a>
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