<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Subject;
use App\Services\GradeService;

class JournalController extends Controller
{
    public function show(Group $group, GradeService $gradeService)
    {
        $users = $group->users()->paginate(5);

        $subjects = Subject::all();

        $subjects_avg = $gradeService->averageGradesSubjects($group);

        $goodUsers = $gradeService->userGrades($group, 4);

        $excellentUsers = $gradeService->userGrades($group, 5);

        return view('journals.show', compact('group', 'users', 'subjects', 'subjects_avg', 'goodUsers', 'excellentUsers'));
    }
}
