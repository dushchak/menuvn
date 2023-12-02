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

    public function editAds(User $user, Ads $adv, $place){
        //$place = Places::find($place);
        //dd($place);
        return $place->user->id === $user->id;
    }
}
