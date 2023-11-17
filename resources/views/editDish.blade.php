@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Редагувати страву до меню</h1>
	<h3>Змінити опис</h3>
	<div class="form__wrapper">
		<form action="{{ route('dish.updatedish', ['dishid'=>$dish->id]) }}" method="POST" >
			@csrf

			<input type="hidden" id="postId" name="dishid" value="{{ $dish->id }}" />


			<div class="form__line">
				<label for="txtName">Назва страви</label>
				<input type="text" name="dishtitle" id="txtName" class="form-control"  value="{{ $dish->dishtitle  }}" placeholder="Піцца Франческа">
			</div>

			<div class="form__line">
				<label for="dish_group">Розділ</label>
				<select name="dishgroup" id="dish_group"  value="{{ $dish->dishgroup  }}">
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
				<textarea id="txtDesc" name="description" rows="5" cols="60"  value="{{ $dish->description  }}" placeholder="20/50/30 Сметана/Дируни/Соус">{{ $dish->description  }}</textarea>

			</div>
			<!--  -->

			<div class="form__line">
				<label for="txtSitPlaces">Вага 1 порції, грамм</label>
				<input type="text" name="portionweight" id="txtName" class="form-control"  value="{{ $dish->portionweight  }}" placeholder="250">
			</div>
			<div class="form__line">
				<label for="txtDelivery">Ціна, грн</label>
				<input type="text" name="portioncost" id="txtName" class="form-control" value="{{ $dish->portioncost  }}" placeholder="135">
			</div>


			<div class="form__line">
				<input type="submit" class="btn btn-primary" value="Редагувати опис">
			</div>
		</form>

	</div>


<div class="updateDishImage">
	<h3>Змінити зображення</h3>

	
	<div class="form__wrapper">
		<img class="dish__image" src="/storage/images/dishes/{{$dish->thumbnail}}" alt="">
		<form action="{{ route('dish.updateDishImage', ['dishid'=>$dish->id]) }}" method="POST" enctype="multipart/form-data" >
			@csrf
			<input type="hidden" name="dish_id" value="{{$dish->id}}">
			<input type="hidden" name="thumbnail" value="{{$dish->thumbnail}}">
			<div class="form__line">
				<label  >Зображення</label>
				<br>
				<input type="file" name="image_file">
			</div>

			<div class="form__line">
				<input type="submit" class="btn btn-primary" value="Завантажити">
			</div>
		</form>
	</div>

	<div class="button">
		<a class="btn btn-primary" href="{{ route('dish.deleteDishImage', ['dishid'=>$dish->id]) }}">Видалити зображення</a>
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