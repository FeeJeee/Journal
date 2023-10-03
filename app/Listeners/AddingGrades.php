<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\Subject;

class AddingGrades
{
    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        foreach (Subject::all() as $subject) {
            $event->user->subjects()->attach($subject->id, ['grade' => rand(2, 5)]);
        }
    }
}
