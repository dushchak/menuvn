<?php
/*
                                            # (*) - обовязкові поля
            $table->id();
            $table->string('name');       # (*) назва закладу
            $table->string('adress');     #(*) 
            $table->string('workhours');  # (*) робочі години
            $table->text('desc');         # (*) опис закладу
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

class Places extends Model
{
#    use HasFactory; // для тестирования
    protected $fillable = [     // поля для массового присваивания
        'name',
        'adress',
        'workhours',
        'desc',
        'sitplaces',
        'delivery',
        'manager',
        'phone1',
        'phone2',
        'phone3',
        'phone4',
        'email',
        'viber',
        'telegram',
        'insta',
        'fb'
        ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
