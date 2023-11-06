@section('navbar')
<div class="navbar">
				<h3><a class="icon_star-solid" href=" {{ route('index') }}"> Білий список</a></h3>
				<h3><a class="icon_percent" href=" {{ route('newsAds') }}"> Акції</a></h3>

				
				@auth
				<a class="icon_heart-circle-plus" href=" {{ route('place_add')  }}">Заклад</a>
					<a class="icon_heart-solid" href=" {{ route('home') }}">Мої заклади</a>
				@endauth
</div>
@endsection