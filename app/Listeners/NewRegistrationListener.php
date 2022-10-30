<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewRegistrationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(UserRegisteredEvent $event)
    {
        //send email here
        Log::info($event->user);

        try {
            Mail::send([], [], function ($mail) use ($event) {
                $mail->to($event->user->email)
                    ->subject('New registration')
                    ->setBody('You Account has been successfully registered', 'text/html');
            });
        } catch (\Exception $e) {
            Log::info($e);
        }

    }
}
