<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Group::factory(3)
            ->has(User::factory(10))
            ->create();

        $groups = Group::all();

        $subjects = Subject::factory(5)->create();

        foreach ($groups as $group)
        {
            foreach ($group->users as $user)
            {
                foreach ($subjects as $subject)
                {
                    $user->subjects()->attach($subject->id, ['grade' => rand(2 ,5)]);
                }
            }
        }
    }
}
