<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->phone = (!empty($user->getAttribute('phone'))) 
                            ? str_replace(['(',')',' '],'', $user->getAttribute('$phone')) 
                            : null;
    }

    public function updating(User $user)
    {
        if($user->isDirty('phone'))
        {
            $user->phone = (!empty($user->getAttribute('phone'))) 
                                ? str_replace(['(',')',' '],'', $user->getAttribute('phone')) 
                                : null;
        }
    }
}
