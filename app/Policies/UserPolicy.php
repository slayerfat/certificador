<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determina si el usuario puede ser actualizado por otro
     *
     * @param User $user
     * @param User $resource
     * @return bool
     */
    public function update(User $user, User $resource)
    {
        return $user->isOwnerOrAdmin($resource->id);
    }
}
