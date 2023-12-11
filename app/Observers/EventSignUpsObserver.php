<?php

namespace App\Observers;

use App\Models\EventSignUps;

class EventSignUpsObserver
{
    public function creating(EventSignUps $event_sign_up){
        $event_sign_up->insert_by = session()->get("user_id");
        $event_sign_up->insert_time = date("Y-m-d H:i:s");
    }

    public function updating(EventSignUps $event_sign_up){
    }
    /**
     * Handle the EventSignUps "created" event.
     */
    public function created(EventSignUps $event_sign_up)
    {
        //
    }

    /**
     * Handle the EventSignUps "updated" event.
     */
    public function updated(EventSignUps $event_sign_up)
    {
        //
    }

    /**
     * Handle the EventSignUps "deleted" event.
     */
    public function deleted(EventSignUps $event_sign_up)
    {
        //
    }

    /**
     * Handle the EventSignUps "restored" event.
     */
    public function restored(EventSignUps $event_sign_up)
    {
        //
    }

    /**
     * Handle the EventSignUps "force deleted" event.
     */
    public function forceDeleted(EventSignUps $event_sign_up)
    {
        //
    }
}
