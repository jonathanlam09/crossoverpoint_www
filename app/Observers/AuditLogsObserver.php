<?php

namespace App\Observers;
use App\Models\AuditLogs;
use Helper;

class AuditLogsObserver
{
    public function creating(AuditLogs $audit){
        $audit->created_by = session()->get('user_id');
        $audit->created_at = date('Y-m-d H:i:s');
        $audit->ip_address = Helper::get_client_ip();
    }

    public function updating(AuditLogs $audit){
    }
    /**
     * Handle the AuditLogs 'created' event.
     */
    public function created(AuditLogs $audit)
    {
        //
    }

    /**
     * Handle the AuditLogs 'updated' event.
     */
    public function updated(AuditLogs $audit)
    {
        //
    }

    /**
     * Handle the AuditLogs 'deleted' event.
     */
    public function deleted(AuditLogs $audit)
    {
        //
    }

    /**
     * Handle the AuditLogs 'restored' event.
     */
    public function restored(AuditLogs $audit)
    {
        //
    }

    /**
     * Handle the AuditLogs 'force deleted' event.
     */
    public function forceDeleted(AuditLogs $audit)
    {
        //
    }
}
