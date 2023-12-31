<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Subject;
use App\Models\User;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Subject::class, 'subject');
    }

    public function index()
    {
        $subjects = Subject::filter()->paginate(5)->withQueryString();

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(StoreSubjectRequest $request)
    {
        Subject::create($request->validated());

        return redirect()->route('subjects.create');
    }

    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return redirect()->route('subjects.show', $subject->id);
    }

    public function destroy(Subject $subject)
    {
        $subject->users()->detach();

        $subject->delete();

        return redirect()->route('subjects.index');
    }
}
