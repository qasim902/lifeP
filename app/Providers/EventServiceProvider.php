<?php

namespace App\Providers;

use App\Events\OrderCreation;
use App\Events\TransactionStatusUpdate;
use App\Events\UserRegisteredEvent;
use App\Listeners\NewRegistrationListener;
use App\Listeners\OrderCreated;
use App\Listeners\TransactionUpdated;
use App\Models\Transaction;
use App\Observers\TransactionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
//            we can either use this, or use created hook of model, i am using created
//            NewRegistrationListener::class
        ],
        //new user registered event and listener
        UserRegisteredEvent::class => [
            NewRegistrationListener::class
        ],

        //order created event
        OrderCreation::class => [
            OrderCreated::class
        ],


//        transaction status update
        TransactionStatusUpdate::class => [
            TransactionUpdated::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Transaction::observe(TransactionObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
