<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderCreated
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // send email here
        Log::info('Order created');
        $user = Auth::user();
        try {
            Mail::send([], [], function ($mail) use ($user) {
                $mail->to($user->email)
                    ->subject('New Order')
                    ->setBody('You Order has been successfully created', 'text/html');
            });
        } catch (\Exception $e) {
            Log::info($e);
        }
    }
}
