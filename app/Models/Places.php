<?php
/*
                                            # (*) - обовязкові поля
            $table->id();
            $table->string('name');       # (*) назва закладу
            $table->string('adress');     #(*) 
            $table->string('workhours');  # (*) робочі години
            $table->text('description');         # (*) опис закладу
            $table->unsignedSmallInteger('sitplaces');   # посадочн місць
            $table->string('delivery');   # що по доставці
            $table->string('manager');    # (*) контакти керуючого viber,tg,....
            $table->string('phone1');      # (*)
            $table->string('phone2');
            $table->string('phone3');
            $table->string('phone4');
            $table->string('email');
            $table->string('viber'); 
            $table->string('telegram');
            $table->string('insta');
            $table->string('fb');
            $table->timestamps();
*/


namespace App\Models;

#use Illuminate\Database\Eloquent\Factories\HasFactory; // для тестирования
use Illuminate\Database\Eloquent\Model;

/*V*/
use App\Models\User;
use App\Models\Dish;
use App\Models\Photo; 

class Places extends Model
{
#    use HasFactory; // для тестирования
    protected $fillable = [     // поля для массового присваивания
        'name',
        'adress',
        'workhours',
        'description',
        'sitplaces',
        'delivery',
        'wifipass',
        'manager',
        'phone1',
        'phone2',
        'phone3',
        'phone4',
        'email',
        'viber',
        'telegram',
        'insta',
        'fb',
        'thumbnail',
        'disabled',
        'moderate',
        'position',
        'adsto',
        'noadsto',
        'wifi',
        ];

    // звязок вгору з клонкою таблиці: users.id
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function dishes(){
        return $this->hasMany(Dish::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function ads(){
        return $this->hasMany(Ads::class);
    }

    public function coins(){
        return $this->hasMany(Coins::class);
    }
}
