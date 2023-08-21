<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\PasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPassword
{
    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        Mail::to($event->user)->send(new PasswordMail($event->password));
    }
}
