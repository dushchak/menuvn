<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Places;

class PlacesPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function updatePlace(User $user, Places $place ){
        //dd($place->user->id);
        return $place->user->id === $user->id;
    }

    public function updatePlaceImage(User $user, Places $place){
        return $this->updatePlace($user, $place);
    }

    public function deletePlaceImage(User $user, Places $place){
        return $this->updatePlace($user, $place);
    }

}
