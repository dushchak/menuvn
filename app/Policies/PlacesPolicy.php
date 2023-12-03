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

    public function before(User $user){
        if($user->isAdmin()) { // 10 - is admin
            return true;
        }
    }

    public function updatePlace(User $user, Places $place ){
        //dd($place->user->id);
        return $place->user->id === $user->id;
    }

    public function deletePlace(User $user, Places $place){
        return $this->updatePlace($user, $place);
    }

    public function deletePlaceImage(User $user, Places $place){
        return $this->updatePlace($user, $place);
    }

    public function changeDish(User $user, Places $place ){
         return  $this->updatePlace($user, $place);
    }

    public function addDish(User $user, Places $place ){
        //dd($place);
        return  $this->updatePlace($user, $place);
    }

    public function newAdv (User $user, Places $place){
        //dd($place);
        return $place->user->id === $user->id;
    }
    

}
