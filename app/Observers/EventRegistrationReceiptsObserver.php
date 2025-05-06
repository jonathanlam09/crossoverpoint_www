<?php

namespace App\Observers;

use App\Models\EventRegistrationReceipts;

class EventRegistrationReceiptsObserver
{
    public function creating(EventRegistrationReceipts $receipt){
        $receipt->created_at = date('Y-m-d H:i:s');
    }

    public function updating(EventRegistrationReceipts $receipt){
    }
    /**
     * Handle the EventRegistrationReceipts 'created' event.
     */
    public function created(EventRegistrationReceipts $receipt)
    {
        //
    }

    /**
     * Handle the EventRegistrationReceipts 'updated' event.
     */
    public function updated(EventRegistrationReceipts $receipt)
    {
        //
    }

    /**
     * Handle the EventRegistrationReceipts 'deleted' event.
     */
    public function deleted(EventRegistrationReceipts $receipt)
    {
        //
    }

    /**
     * Handle the EventRegistrationReceipts 'restored' event.
     */
    public function restored(EventRegistrationReceipts $receipt)
    {
        //
    }

    /**
     * Handle the EventRegistrationReceipts 'force deleted' event.
     */
    public function forceDeleted(EventRegistrationReceipts $receipt)
    {
        //
    }
}
