<?php

namespace App\Observers;

use App\Models\EventRegistrations;

class EventRegistrationsObserver
{
    public function creating(EventRegistrations $registration){
        $registration->created_at = date('Y-m-d H:i:s');
    }

    public function updating(EventRegistrations $registration){
    }
    /**
     * Handle the EventRegistrations 'created' event.
     */
    public function created(EventRegistrations $registration)
    {
        //
    }

    /**
     * Handle the EventRegistrations 'updated' event.
     */
    public function updated(EventRegistrations $registration)
    {
        //
    }

    /**
     * Handle the EventRegistrations 'deleted' event.
     */
    public function deleted(EventRegistrations $registration)
    {
        //
    }

    /**
     * Handle the EventRegistrations 'restored' event.
     */
    public function restored(EventRegistrations $registration)
    {
        //
    }

    /**
     * Handle the EventRegistrations 'force deleted' event.
     */
    public function forceDeleted(EventRegistrations $registration)
    {
        //
    }
}
