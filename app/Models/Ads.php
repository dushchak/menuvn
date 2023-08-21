<?php
/*
 $table->id();
            $table->string('title');
            $table->text('description')->nullable(); 
            $table->string('img'); # filename
            $table->unsignedTinyInteger('typeads'); #img / img+txt
            $table->date('payed_at')->nullable(); # date
            $table->unsignedTinyInteger('moderate'); # 0/1
            $table->foreignId('places_id');
            $table->timestamps();

*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Places;

class Ads extends Model
{
    #use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'img',
        'typeads',
        'payed_at',
        'moderate',
        'places_id',
    ];

    public function place(){
        return $this->belongsTo(Places::class);
    }

}
