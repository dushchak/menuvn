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

use App\Models\Places;


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
        'position',
        'thumbnail'
    ];


    public function oneplace(){
        return $this->belongsTo(Places::class);
    }

    

}
