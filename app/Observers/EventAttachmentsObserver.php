<?php

namespace App\Observers;

use App\Models\EventAttachments;

class EventAttachmentsObserver
{
    public function creating(EventAttachments $attachment){
        $attachment->created_at = date('Y-m-d H:i:s');
        $attachment->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(EventAttachments $attachment){
        $attachment->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the EventAttachments 'created' event.
     */
    public function created(EventAttachments $attachment)
    {
        //
    }

    /**
     * Handle the EventAttachments 'updated' event.
     */
    public function updated(EventAttachments $attachment)
    {
        //
    }

    /**
     * Handle the EventAttachments 'deleted' event.
     */
    public function deleted(EventAttachments $attachment)
    {
        //
    }

    /**
     * Handle the EventAttachments 'restored' event.
     */
    public function restored(EventAttachments $attachment)
    {
        //
    }

    /**
     * Handle the EventAttachments 'force deleted' event.
     */
    public function forceDeleted(EventAttachments $attachment)
    {
        //
    }
}
