<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    /**
     * Handle the Article "creating" event.
     *
     * @param  \App\Models\User  $article
     * @return void
     */
    public function creating(User $user)
    {
        $user->password = Hash::make($user->password);
    }

    /**
     * Handle the User "updating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        $user->password = Hash::make($user->password);
    }
}
