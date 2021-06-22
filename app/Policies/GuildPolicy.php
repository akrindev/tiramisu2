<?php

namespace App\Policies;

use App\Guild;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuildPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function view(User $user, Guild $guild)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function update(User $user, Guild $guild)
    {
        return $user->id === $guild->manager_id || $guild->canManageGuild($user->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function delete(User $user, Guild $guild)
    {
        return $user->id === $guild->manager_id || $guild->canManageGuild($user->id);
    }

    /**
     * Wakil can add member
     */
    public function addMember(User $user, Guild $guild)
    {
        return $user->id === $guild->manager_id || $guild->canManageGuild($user->id, 'inviter');
    }

    /**
     * Wakil can add member
     */
    public function removeMember(User $user, Guild $guild)
    {
        return $user->id === $guild->manager_id || $guild->canManageGuild($user->id);
    }

    /**
     * Ketua dapat memindahtangankan ketua
     */
    public function manager(User $user, Guild $guild)
    {
        return $user->id === $guild->manager_id || $guild->isManager();
    }

    /**
     * admin can delete guild or its manager
     */
    public function deleteGuild(User $user, Guild $guild)
    {
        return $user->id === $guild->manager_id || $guild->isManager() || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function restore(User $user, Guild $guild)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function forceDelete(User $user, Guild $guild)
    {
        //
    }
}
