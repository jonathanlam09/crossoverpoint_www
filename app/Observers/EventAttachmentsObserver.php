<?php

namespace App\Observers;

use App\Models\EventAttachments;

class EventAttachmentsObserver
{
    public function creating(EventAttachments $event_attachment){
        $event_attachment->insert_by = session()->get("user_id");
        $event_attachment->update_by = session()->get("user_id");
        $event_attachment->insert_time = date("Y-m-d H:i:s");
        $event_attachment->update_time = date("Y-m-d H:i:s");
    }

    public function updating(EventAttachments $event_attachment){
        $event_attachment->update_by = session()->get("user_id");
        $event_attachment->update_time = date("Y-m-d H:i:s");
    }
    /**
     * Handle the EventAttachments "created" event.
     */
    public function created(EventAttachments $event_attachment)
    {
        //
    }

    /**
     * Handle the EventAttachments "updated" event.
     */
    public function updated(EventAttachments $event_attachment)
    {
        //
    }

    /**
     * Handle the EventAttachments "deleted" event.
     */
    public function deleted(EventAttachments $event_attachment)
    {
        //
    }

    /**
     * Handle the EventAttachments "restored" event.
     */
    public function restored(EventAttachments $event_attachment)
    {
        //
    }

    /**
     * Handle the EventAttachments "force deleted" event.
     */
    public function forceDeleted(EventAttachments $event_attachment)
    {
        //
    }
}
