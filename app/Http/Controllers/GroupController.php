<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::paginate(5);

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
//        dd($group);
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
            foreach ($user->subjects as $subject)
            {
                $user->subjects()->detach($subject->id);
            };

            $user->delete();
        };

        $group->delete();

        return redirect()->back();
    }
}
