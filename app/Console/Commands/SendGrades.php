<?php

namespace App\Console\Commands;

use App\Jobs\SendGrades as JobsSendGrades;
use App\Models\User;
use Illuminate\Console\Command;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (User::all() as $user) {
            dispatch(new JobsSendGrades($user))->onQueue('emails');
        }
    }
}
