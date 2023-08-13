<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Subject;

class GradeService
{
    public function averageGradesSubjects(Group $group):array
    {
        $subjects = Subject::all();

        $subjects_avg = [];

        foreach ($subjects as $subject)
        {
            $subject_avg = $subject->users()->where('group_id', $group->id)->avg('grade');
            $subjects_avg[$subject->id] = round($subject_avg, 2);
        }

        return ($subjects_avg);
    }

    public function userGrades(Group $group, int $grade)
    {
        $group->load('users.subjects');

        $usersList = $group->users->filter(function ($user) use ($grade){
           return ($user->subjects()->min('grade') == $grade);
        });

        return ($usersList);
    }
}
