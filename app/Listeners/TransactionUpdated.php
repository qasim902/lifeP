<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransactionUpdated
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
        Log::info('transaction updated');
        $user = Auth::user();
        try {
            Mail::send([], [], function ($mail) use ($user) {
                $mail->to($user->email)
                    ->subject('Transaction updated')
                    ->setBody('You Transaction has been successfully toggled', 'text/html');
            });
        } catch (\Exception $e) {
            Log::info($e);
        }
    }
}
