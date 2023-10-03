<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class GradePolicy
{
    public function editCreate(User $user, User $model)
    {
        return $user->group->id === $model->group->id ? Response::allow() : Response::deny('Alien group');
    }

    public function storeUpdateDelete(User $user, User $model)
    {
        return ! ($user->isStudent)
            ? $user->group->id === $model->group->id
                ? $model->isAdmin
                    ? Response::deny('This user is an administrator')
                    : Response::allow()
                : Response::deny('Alien group')
            : Response::deny('You must be teacher or administrator');
    }
}
