<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
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
    public function edit(User $user, User $model): bool
    {
        return ($user->isAdmin && $user->group->id === $model->group->id && ! $model->isAdmin) || ($user->isTeacher && $user->group->id === $model->group->id && $model->isStudent);
    }

    public function update(User $user, User $model, array $request): bool
    {
        return ($user->isAdmin && $request['role'] != 0 && ! $model->isAdmin) || ($user->isTeacher && $model->group->id == $request['group_id'] && $model->role == $request['role']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin && ($user->group->id === $model->group->id && ! $model->isAdmin) || ($user->isTeacher && $user->group->id === $model->group->id && $model->isStudent);
    }

    public function store(User $user, array $request)
    {
        return $user->isAdmin && $request['role'] != 0;
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->isAdmin && ! $model->isAdmin;
    }
}
