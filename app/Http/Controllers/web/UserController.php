<?php

namespace App\Http\Controllers\web;

use App\Enums\UserRole;
use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Group;
use App\Models\User;
use App\Services\FileService;

class UserController extends Controller
{
    public function __construct(
        protected FileService $fileService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withTrashed(request()->user()->isAdmin)->filter()->paginate(5)->withQueryString();

        $user_roles = UserRole::cases();

        return view('users.index', compact('users', 'user_roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $groups = Group::all();

        $user_roles = UserRole::cases();

        return view('users.create', compact('groups', 'user_roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('store', [User::class, $request->validated()]);

        $user = User::create($request->validated());

        event(new UserCreated($user, $request->validated('password')));

        return redirect()->route('users.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $subjects = $user->subjects()->paginate(5);

        return view('users.show', compact('user', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        $groups = Group::all();

        $user_roles = UserRole::cases();

        return view('users.edit', compact('user', 'groups', 'user_roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', [$user, $request->validated()]);

        $user->update($request->validated());

        return redirect()->route('users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index');
    }

    public function toPdf(User $user)
    {
        return $this->fileService->userToPdf($user);
    }

    public function restore(User $user)
    {
        if ($user->trashed()) {
            $user->restore();
        }

        return redirect()->route('users.index');
    }

    public function forceDelete(User $user)
    {
        if ($user->trashed()) {
            $user->subjects()->detach();

            $user->forceDelete();
        }

        return redirect()->route('users.index');
    }
}
