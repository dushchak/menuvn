@extends('layouts.base')

@section('title')

@section('main')
<div class="container">
	<h1>Підняти в ТОП - {{$place->name}}</h1>
	<p>Підключіть показ вашої реклами на сторінках Menu.vn.ua. Ви можете показувати цільовій аудиторії ваші оголошення, розкажіть про ваші знижки та акційні пропозиції</p>
	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum ipsa suscipit repellat exercitationem consequuntur quam, alias, assumenda cupiditate, commodi eligendi consequatur voluptate illo? Sequi et explicabo totam nostrum. Voluptates, aliquid.</p>

	<p>Ціна: 10 монет/місяць</p>
<form action="{{ route('coins.payads', $place) }}" method="POST" >
	@csrf

	<input type="hidden" name="typeoperation" value="upplace">
	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Оплатити">
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