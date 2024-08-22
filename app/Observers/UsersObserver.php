<?php

namespace App\Observers;

use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class UsersObserver
{
    public function creating(Users $user){
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(Users $user){
        $user->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the Users 'created' event.
     */
    public function created(Users $user)
    {
    }

    /**
     * Handle the Users 'updated' event.
     */
    public function updated(Users $user)
    {
        //
    }

    /**
     * Handle the Users 'deleted' event.
     */
    public function deleted(Users $user)
    {
        //
    }

    /**
     * Handle the Users 'restored' event.
     */
    public function restored(Users $user)
    {
        //
    }

    /**
     * Handle the Users 'force deleted' event.
     */
    public function forceDeleted(Users $user)
    {
        //
    }
}
