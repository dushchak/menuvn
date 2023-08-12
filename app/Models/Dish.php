<?php

/*
            $table->id();
            $table->string('dishtitle');
            $table->string('dishgroup')->nullable(); 
            $table->text('description');
            $table->string('portionweight')->nullable();
            $table->string('portioncost');
            $table->string('cost100g')->nullable();
*/

namespace App\Models;

#use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*V*/
use App\Models\Places;
use App\Models\Photo; 

class Dish extends Model
{
    #use HasFactory;
    protected $fillable = [
        'dishtitle',
        'dishgroup',
        'description',
        'portionweight',
        'portioncost',
        'cost100g',
        'places_id',
        'thumbnail'
    ];

    

}
