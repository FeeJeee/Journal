<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Group;



class GroupController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Group::class, 'group');
    }

    public function index()
    {
        $groups = Group::filter()->paginate(5)->withQueryString();

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(StoreGroupRequest $request)
    {
        Group::create($request->validated());

        return redirect()->route('groups.create');
    }

    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        return redirect()->route('groups.show', $group->id);
    }

    public function destroy(Group $group)
    {
        foreach ($group->users as $user)
        {
            $user->subjects()->detach();

            $user->delete();
        }

        $group->delete();

        return redirect()->route('groups.index');
    }
}
