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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Group::factory()
            ->count(3)
            ->has(User::factory()->count(5), 'users')
            ->create();

//        dd(rand(0,19));

        $users = User::all();

//        Subject::factory()
//            ->count(5)
//            ->hasAttached($users, ['grade' => rand(2,5)])
//            ->create();

        foreach ($users as $user)
        {
            for($x=0; $x < 3; $x++)
            {
                Subject::factory()
                    ->hasAttached($user, ['grade' => rand(2, 5)])
                    ->create();
            }
        }
    }
}
