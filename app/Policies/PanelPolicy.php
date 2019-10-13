<?php

namespace App\Policies;

use App\User;
use App\Panel;
use Illuminate\Auth\Access\HandlesAuthorization;

class PanelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the panel.
     *
     * @param  \App\User  $user
     * @param  \App\Panel  $panel
     * @return mixed
     */
    public function update(User $user, Panel $panel)
    {
        return $panel->user_id == $user->id;
    }

}
