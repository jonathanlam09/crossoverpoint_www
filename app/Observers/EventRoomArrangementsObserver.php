<?php

namespace App\Observers;

use App\Models\EventRoomArrangements;

class EventRoomArrangementsObserver
{
    public function creating(EventRoomArrangements $arrangement){
    }

    public function updating(EventRoomArrangements $arrangement){
    }
    /**
     * Handle the EventRoomArrangements 'created' event.
     */
    public function created(EventRoomArrangements $arrangement)
    {
        //
    }

    /**
     * Handle the EventRoomArrangements 'updated' event.
     */
    public function updated(EventRoomArrangements $arrangement)
    {
        //
    }

    /**
     * Handle the EventRoomArrangements 'deleted' event.
     */
    public function deleted(EventRoomArrangements $arrangement)
    {
        //
    }

    /**
     * Handle the EventRoomArrangements 'restored' event.
     */
    public function restored(EventRoomArrangements $arrangement)
    {
        //
    }

    /**
     * Handle the EventRoomArrangements 'force deleted' event.
     */
    public function forceDeleted(EventRoomArrangements $arrangement)
    {
        //
    }
}
