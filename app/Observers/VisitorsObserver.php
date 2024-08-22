<?php

namespace App\Observers;

use App\Models\Visitors;

class VisitorsObserver
{
    public function creating(Visitors $visitor){
        $visitor->created_by = session()->get('user_id');
        $visitor->updated_by = session()->get('user_id');
        $visitor->created_at = date('Y-m-d H:i:s');
        $visitor->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(Visitors $visitor){
        $visitor->updated_by = session()->get('user_id');
        $visitor->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the Visitors 'created' event.
     */
    public function created(Visitors $visitor)
    {
        //
    }

    /**
     * Handle the Visitors 'updated' event.
     */
    public function updated(Visitors $visitor)
    {
        //
    }

    /**
     * Handle the Visitors 'deleted' event.
     */
    public function deleted(Visitors $visitor)
    {
        //
    }

    /**
     * Handle the Visitors 'restored' event.
     */
    public function restored(Visitors $visitor)
    {
        //
    }

    /**
     * Handle the Visitors 'force deleted' event.
     */
    public function forceDeleted(Visitors $visitor)
    {
        //
    }
}
