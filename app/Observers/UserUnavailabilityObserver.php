<?php

namespace App\Observers;

use App\Models\AuditLogs;
use App\Models\UserUnavailability;
use App\Models\Users;
use Helper;
use Exception;

class UserUnavailabilityObserver
{
    public function creating(UserUnavailability $user_unavailability){
        $user_unavailability->insert_by = session()->get("user_id");
        $user_unavailability->update_by = session()->get("user_id");
        $user_unavailability->insert_time = date("Y-m-d H:i:s");
        $user_unavailability->update_time = date("Y-m-d H:i:s");
    }

    public function updating(UserUnavailability $user_unavailability){
        $user_unavailability->update_by = session()->get("user_id");
        $user_unavailability->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $user_unavailability->getDirty();
        $old_data = $user_unavailability->getOriginal();

        foreach($new_data as $key=>$row){
            if($key != "update_by" && $key != "update_time"){
                $old = $old_data[$key];
                $prev_dt[$key] = $old;
                $new_dt[$key] =  $row;
            }
        }

        $user = Users::where([
            "id" => session()->get("user_id"),
            "active" => 1
        ])->first();
        if(!$user){
            throw new Exception("User not found!");
        }

        $data = [
            "prev_data" => json_encode($prev_dt),
            "new_data" => json_encode($new_dt),
            "model" => "user",
            "operation" => "U",
            "ref_id" => Helper::encrypt($user_unavailability->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the UserUnavailability "created" event.
     */
    public function created(UserUnavailability $user_unavailability)
    {
        AuditLogs::create([
            "model" => "user",
            "operation" => "C",
            "ref_id" => Helper::encrypt($user_unavailability->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the UserUnavailability "updated" event.
     */
    public function updated(UserUnavailability $user_unavailability)
    {
        //
    }

    /**
     * Handle the UserUnavailability "deleted" event.
     */
    public function deleted(UserUnavailability $user_unavailability)
    {
        //
    }

    /**
     * Handle the UserUnavailability "restored" event.
     */
    public function restored(UserUnavailability $user_unavailability)
    {
        //
    }

    /**
     * Handle the UserUnavailability "force deleted" event.
     */
    public function forceDeleted(UserUnavailability $user_unavailability)
    {
        //
    }
}
