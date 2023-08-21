        <div class="dish">
            <div class="dish__image">
                <img class="img" src="/storage/images/dishes/{{$dish->thumbnail}}" alt="">
            </div>
            <div class="dish__info">
                <h4>{{ $dish->dishtitle }}</h4>
                <p>Порція, вага: {{ $dish->portionweight }} грам</p>
                <p>Ціна за 100гр: {{ $dish->cost100g }} грн</p>
                <p>Ціна за порцію: {{ $dish->portioncost }} грн</p>
                <p>{{ $dish->description }}</p>
            </div>

            <div class="dish__actions">
                 <td>Замовити </td>
                     @auth
                    <a href="{{ route('dish.up', $dish->id)  }}">+</a>
                    <a href="{{ route('dish.down', $dish->id)  }}">-</a>
                    <a href="{{ route('dish.editdish', $dish->id) }}">edit</a>
                    <a href="{{ route('dish.formdeldish', $dish->id) }}">delete</a>                @endauth
                    @guest
                    <a href="">Повідомити про помилку</a>
                    @endguest
            </div>    
        </div>