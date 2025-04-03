<?php

namespace App\Observers;

use App\Models\EventRoomAttachments;

class EventRoomAttachmentsObserver
{
    public function creating(EventRoomAttachments $attachment){
        $attachment->created_by = session()->get('user_id');
        $attachment->updated_by = session()->get('user_id');
        $attachment->created_at = date('Y-m-d H:i:s');
        $attachment->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(EventRoomAttachments $attachment){
        $attachment->updated_by = session()->get('user_id');
        $attachment->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the EventRoomAttachments 'created' event.
     */
    public function created(EventRoomAttachments $attachment)
    {
        //
    }

    /**
     * Handle the EventRoomAttachments 'updated' event.
     */
    public function updated(EventRoomAttachments $attachment)
    {
        //
    }

    /**
     * Handle the EventRoomAttachments 'deleted' event.
     */
    public function deleted(EventRoomAttachments $attachment)
    {
        //
    }

    /**
     * Handle the EventRoomAttachments 'restored' event.
     */
    public function restored(EventRoomAttachments $attachment)
    {
        //
    }

    /**
     * Handle the EventRoomAttachments 'force deleted' event.
     */
    public function forceDeleted(EventRoomAttachments $attachment)
    {
        //
    }
}
