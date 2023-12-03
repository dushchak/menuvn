<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ads;
use App\Models\Places;

class AdsPolicy
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

    // public function newAdv (User $user, Places $place){
    //     dd($place);
    //     return $place->user->id === $user->id;
    // }

    public function editformAds(User $user, Ads $adv, Places $place){
        //dd($adv->place()->get());
        //dd($place);
        return $place->user->id === $user->id;
    }

    public function editAds(User $user, Ads $adv, $place){
        //dd($place);
        $place = Places::find($place);
        return $place->user->id === $user->id;
    }

    public function deleteAds(User $user,Ads $adv, $place){
        //dd($adv->places_id);
        $places_id = $adv->places_id;
        $place = Places::find($places_id);
        return $place->user->id === $user->id;
    }

}
