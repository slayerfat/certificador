<?php

namespace App\Policies;

use App\PersonalDetail;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalDetailPolicy
{
    use HandlesAuthorization;

    /**
     * @param \App\User $user
     * @param \App\PersonalDetail $details
     * @return bool
     */
    public function createProfessor(
        User $user,
        PersonalDetail $details
    ) {
        return $user->isOwnerOrAdmin($details->user_id);
    }
}
