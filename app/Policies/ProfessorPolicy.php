<?php

namespace App\Policies;

use App\Professor;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessorPolicy
{
    use HandlesAuthorization;

    /**
     * @param \App\User $user
     * @param \App\Professor $professor
     * @return bool
     */
    public function update(
        User $user,
        Professor $professor
    ) {
        return $user->isOwnerOrAdmin($professor->personalDetails->user_id);
    }
}
