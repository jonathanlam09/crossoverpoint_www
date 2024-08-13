<?php

namespace App\Observers;

use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class UsersObserver
{
    public function creating(Users $user){
        $user->insert_by = session()->get("user_id");
        $user->update_by = session()->get("user_id");
        $user->insert_time = date("Y-m-d H:i:s");
        $user->update_time = date("Y-m-d H:i:s");
    }

    public function updating(Users $user){
        $user->update_by = session()->get("user_id");
        $user->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $user->getDirty();
        $old_data = $user->getOriginal();

        foreach($new_data as $key=>$row){
            if($key != "update_by" && $key != "update_time" && $key != "portal_access_token"){
                $old = $old_data[$key];
                $prev_dt[$key] = $old;
                $new_dt[$key] =  $row;
            }
        }

        $user = Users::where([
            "id" => session()->get("user_id"),
            "active" => 1
        ])->first();

        $data = [
            "prev_data" => json_encode($prev_dt),
            "new_data" => json_encode($new_dt),
            "model" => "user",
            "operation" => "U",
            "ip_address" => Helper::get_client_ip()
        ];
        
        if($user){
            $data["ref_id"] = Helper::encrypt($user->id);
        }
        AuditLogs::create($data);
    }
    /**
     * Handle the Users "created" event.
     */
    public function created(Users $user)
    {
        AuditLogs::create([
            "model" => "user",
            "operation" => "C",
            "ref_id" => Helper::encrypt($user->id),
            "ip_address" => Helper::get_client_ip()
        ]);
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
