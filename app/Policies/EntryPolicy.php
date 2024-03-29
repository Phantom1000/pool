<?php

namespace App\Policies;

use App\Models\Entry;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entry  $entry
     * @return mixed
     */
    public function delete(User $user, Entry $entry)
    {
        return $user->hasRoles('admin', 'controller', 'seller') || $entry->user_id === $user->id && $entry->state == 0;
    }
}
