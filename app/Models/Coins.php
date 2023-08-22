<?php

namespace App\Models;

#use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Places;

class Coins extends Model
{
    #use HasFactory;
    protected $fillable = [
        'coins_before',
        'operation_sum',
        'coins_after',
        'operator_id',
        'typeoperation',
        'comment',
    ];

    public function oneplace(){
        return $this->belongsTo(Places::class);
    }
}
