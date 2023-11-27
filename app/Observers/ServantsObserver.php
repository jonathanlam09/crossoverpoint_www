<?php

namespace App\Observers;

use App\Models\Servants;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class ServantsObserver
{
    public function creating(Servants $servant){
        $servant->insert_by = session()->get("user_id");
        $servant->update_by = session()->get("user_id");
        $servant->insert_time = date("Y-m-d H:i:s");
        $servant->update_time = date("Y-m-d H:i:s");
    }

    public function updating(Servants $servant){
        $servant->update_by = session()->get("user_id");
        $servant->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $servant->getDirty();
        $old_data = $servant->getOriginal();
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
            "model" => "servant",
            "operation" => "U",
            "ref_id" => Helper::encrypt($servant->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Servants "created" event.
     */
    public function created(Servants $servant)
    {
        AuditLogs::create([
            "model" => "servant",
            "operation" => "C",
            "ref_id" => Helper::encrypt($servant->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Servants "updated" event.
     */
    public function updated(Servants $servant)
    {
        //
    }

    /**
     * Handle the Servants "deleted" event.
     */
    public function deleted(Servants $servant)
    {
        //
    }

    /**
     * Handle the Servants "restored" event.
     */
    public function restored(Servants $servant)
    {
        //
    }

    /**
     * Handle the Servants "force deleted" event.
     */
    public function forceDeleted(Servants $servant)
    {
        //
    }
}
