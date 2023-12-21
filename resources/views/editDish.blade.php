@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Редагувати страву до меню</h1>
	<h3>Змінити опис</h3>
	<div class="form__wrapper">
		<form action="{{ route('dish.updatedish', ['dishid'=>$dish->id]) }}" method="POST" enctype="multipart/form-data">
			@csrf

			<input type="hidden" id="postId" name="dishid" value="{{ $dish->id }}" />


			<div class="form__line">
				<label for="txtName">Назва страви</label>
				@if($errors->has('dishtitle'))
					<input type="text" name="dishtitle" id="txtName" class="form-control error_field"  value="{{ $dish->dishtitle  }}" placeholder="Піцца Франческа">
				@else
					<input type="text" name="dishtitle" id="txtName" class="form-control"  value="{{ $dish->dishtitle  }}" placeholder="Піцца Франческа">
				@endif
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('dishtitle') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
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
				@if($errors->has('description'))
					<textarea id="txtDesc" name="description" rows="5" cols="60"  value="{{ $dish->description  }}" placeholder="20/50/30 Сметана/Дируни/Соус" class="error_field">{{ $dish->description  }}</textarea>
				@else
					<textarea id="txtDesc" name="description" rows="5" cols="60"  value="{{ $dish->description  }}" placeholder="20/50/30 Сметана/Дируни/Соус">{{ $dish->description  }}</textarea>
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
				<label for="txtSitPlaces">Вага 1 порції, грамм</label>
				@if($errors->has('portionweight'))
					<input type="text" name="portionweight" id="txtName" class="form-control error_field"  value="{{ $dish->portionweight  }}" placeholder="250">
				@else
					<input type="text" name="portionweight" id="txtName" class="form-control"  value="{{ $dish->portionweight  }}" placeholder="250">
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
				<label for="txtDelivery">Ціна, грн</label>
				@if($errors->has('portioncost'))
					<input type="text" name="portioncost" id="txtName" class="form-control error_field" value="{{ $dish->portioncost  }}" placeholder="135">
				@else
					<input type="text" name="portioncost" id="txtName" class="form-control" value="{{ $dish->portioncost  }}" placeholder="135">
				@endif
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('portioncost') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>

			

			<img class="dish__image" src="/storage/images/dishes/{{$dish->thumbnail}}" alt="">

			<div class="form__line">
				
				<label  >Зображення</label>
				<br>
				<input type="file" name="image_file" >
			</div>
			<div class="field_error">
					<ul>
					@foreach($errors->get('image_file') as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
			</div>




			<div class="form__line">
				<input type="submit" class="btn btn-primary" value="Редагувати опис">
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