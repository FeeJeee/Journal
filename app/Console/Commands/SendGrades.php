<?php

namespace App\Console\Commands;

use App\Mail\GradesMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendGrades extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:sendGrades';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send grades to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (User::all() as $user) {
            {
                if ($user->isAdmin)
                {
                    Mail::to($user->email)->send(new GradesMail($user));
                }
            }
        }
    }
}
