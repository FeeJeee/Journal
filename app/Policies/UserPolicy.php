<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin || $user->isTeacher;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function edit(User $user, User $model):bool
    {
        return ($user->isAdmin && $user->group->id === $model->group->id && $model->role != 0) || ($user->isTeacher && $user->group->id === $model->group->id && $model->isStudent);
    }

    public function update( User $user, User $model, array $request): bool
    {
        return ($user->isAdmin && $request['role'] != 0) || ($user->isTeacher && $model->group->id == $request['group_id'] && $model->role == $request['role']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin && ($user->group->id === $model->group->id && !($model->isAdmin)) || $user->isTeacher && ($user->group->id === $model->group->id && $model->isStudent);
    }

    public function store(User $user, array $request)
    {
        return $user->isAdmin && $request['role'] != 0 || ($user->isTeacher && $user->group->id == $request['group_id'] && $request['role'] == 2);
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->isAdmin && !($model->isAdmin);
    }
}
