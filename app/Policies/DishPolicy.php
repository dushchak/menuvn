<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Places;

class DishPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // public function changeDish(User $user, Places $place ){
    //      return $place->user->id === $user->id;
    // }

    // public function addDish(User $user, Places $place ){
    //     //dd($place);
    //     return $this->changeDish($user, $place);
    // }
}
