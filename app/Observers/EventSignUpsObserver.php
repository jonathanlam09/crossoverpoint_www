<?php

namespace App\Observers;

use App\Models\EventSignUps;

class EventSignUpsObserver
{
    public function creating(EventSignUps $sign_up){
        $sign_up->created_at = date('Y-m-d H:i:s');
    }

    public function updating(EventSignUps $sign_up){
    }
    /**
     * Handle the EventSignUps 'created' event.
     */
    public function created(EventSignUps $sign_up)
    {
        //
    }

    /**
     * Handle the EventSignUps 'updated' event.
     */
    public function updated(EventSignUps $sign_up)
    {
        //
    }

    /**
     * Handle the EventSignUps 'deleted' event.
     */
    public function deleted(EventSignUps $sign_up)
    {
        //
    }

    /**
     * Handle the EventSignUps 'restored' event.
     */
    public function restored(EventSignUps $sign_up)
    {
        //
    }

    /**
     * Handle the EventSignUps 'force deleted' event.
     */
    public function forceDeleted(EventSignUps $sign_up)
    {
        //
    }
}
