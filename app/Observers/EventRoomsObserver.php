<?php

namespace App\Observers;

use App\Models\EventRooms;

class EventRoomsObserver
{
    public function creating(EventRooms $room){
        $room->created_by = session()->get('user_id');
        $room->updated_by = session()->get('user_id');
        $room->created_at = date('Y-m-d H:i:s');
        $room->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(EventRooms $room){
        $room->updated_by = session()->get('user_id');
        $room->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the EventRooms 'created' event.
     */
    public function created(EventRooms $room)
    {
        //
    }

    /**
     * Handle the EventRooms 'updated' event.
     */
    public function updated(EventRooms $room)
    {
        //
    }

    /**
     * Handle the EventRooms 'deleted' event.
     */
    public function deleted(EventRooms $room)
    {
        //
    }

    /**
     * Handle the EventRooms 'restored' event.
     */
    public function restored(EventRooms $room)
    {
        //
    }

    /**
     * Handle the EventRooms 'force deleted' event.
     */
    public function forceDeleted(EventRooms $room)
    {
        //
    }
}
