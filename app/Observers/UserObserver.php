<?php

namespace App\Observers;

use App\Models\User;
use App\Services\FileService;

class UserObserver
{
    public function __construct(
        protected FileService $fileService,
    ) {}
    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->fileService->deleteAvatar($user);
    }
}
