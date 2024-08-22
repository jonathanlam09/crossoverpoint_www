<?php

namespace App\Observers;

use App\Models\Services;
use App\Models\Users;
use App\Models\AuditLogs;
use Helper;
use Exception;

class ServicesObserver
{
    public function creating(Services $service){
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(Services $service){
        $service->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the Services 'created' event.
     */
    public function created(Services $service)
    {
    }

    /**
     * Handle the Services 'updated' event.
     */
    public function updated(Services $service)
    {
        //
    }

    /**
     * Handle the Services 'deleted' event.
     */
    public function deleted(Services $service)
    {
        //
    }

    /**
     * Handle the Services 'restored' event.
     */
    public function restored(Services $service)
    {
        //
    }

    /**
     * Handle the Services 'force deleted' event.
     */
    public function forceDeleted(Services $service)
    {
        //
    }
}
