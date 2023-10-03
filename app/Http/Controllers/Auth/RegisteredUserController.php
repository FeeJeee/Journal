<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $groups = Group::all();

        $user_roles = UserRole::cases();

        return view('auth.register', compact('groups', 'user_roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        event(new Registered($user));

        event(new UserCreated($user, $request->validated('password')));

        Auth::login($user);

        return redirect('/profile');
    }
}
