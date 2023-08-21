<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use App\Policies\GradePolicy;
use App\Policies\GroupPolicy;
use App\Policies\SubjectPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Group::class => GroupPolicy::class,
        Subject::class => SubjectPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('edit-create-grade', [GradePolicy::class, 'editCreate']);
        Gate::define('store-update-delete-grade', [GradePolicy::class, 'storeUpdateDelete']);
    }
}
