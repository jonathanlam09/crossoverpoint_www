<?php

namespace App\Observers;

use App\Models\Users;

class UsersObserver
{
    public function creating(Users $user){
        $user->insert_by = session()->get("Users_id");
        $user->update_by = session()->get("Users_id");
        $user->insert_time = date("Y-m-d H:i:s");
        $user->update_time = date("Y-m-d H:i:s");
    }

    public function updating(Users $user){
        $user->update_by = session()->get("Users_id");
        $user->update_time = date("Y-m-d H:i:s");
    }
    /**
     * Handle the Users "created" event.
     */
    public function created(Users $user)
    {
        //
    }

    /**
     * Handle the Users "updated" event.
     */
    public function updated(Users $user)
    {
        //
    }

    /**
     * Handle the Users "deleted" event.
     */
    public function deleted(Users $user)
    {
        //
    }

    /**
     * Handle the Users "restored" event.
     */
    public function restored(Users $user)
    {
        //
    }

    /**
     * Handle the Users "force deleted" event.
     */
    public function forceDeleted(Users $user)
    {
        //
    }
}
