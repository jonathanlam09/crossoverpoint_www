<?php

namespace App\Observers;

use App\Models\Events;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class EventsObserver
{
    public function creating(Events $event){
        $event->created_at = date('Y-m-d H:i:s');
        $event->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(Events $event){
        $event->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the Events 'created' event.
     */
    public function created(Events $event)
    {
    }

    /**
     * Handle the Events 'updated' event.
     */
    public function updated(Events $event)
    {
        // 
    }

    /**
     * Handle the Events 'deleted' event.
     */
    public function deleted(Events $event)
    {
        //
    }

    /**
     * Handle the Events 'restored' event.
     */
    public function restored(Events $event)
    {
        //
    }

    /**
     * Handle the Events 'force deleted' event.
     */
    public function forceDeleted(Events $event)
    {
        //
    }
}
