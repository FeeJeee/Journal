<?php

namespace App\Http\Controllers;

use App\Http\Requests\Grade\StoreGradeRequest;
use App\Http\Requests\Grade\UpdateGradeRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $subjects = Subject::all();

        return view('grades.create', compact('user', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request, User $user)
    {
        $user->subjects()->attach($request->validated()['subject_id'], $request->validated());

        return redirect()->route('users.show', $user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Subject $subject)
    {
        $subject = $user->subjects()->find($subject->id);

        return view('grades.edit', compact('user', 'subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, User $user, Subject $subject)
    {
        $user->subjects()->detach($subject->id);

        $user->subjects()->attach($subject->id, $request->validated());

        return redirect()->route('users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Subject $subject)
    {
        $user->subjects()->detach($subject->id);

        return redirect()->back();
    }
}
