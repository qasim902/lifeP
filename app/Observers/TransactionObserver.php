<?php

namespace App\Observers;

use App\Events\TransactionStatusUpdate;
use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    public function updating(Transaction $transaction)
    {
        TransactionStatusUpdate::dispatchIf($transaction->isDirty('status'), $transaction);
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
