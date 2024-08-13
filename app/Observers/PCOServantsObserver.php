<?php

namespace App\Observers;

use App\Models\PCOServants;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCOServantsObserver
{
    public function creating(PCOServants $PCOservant){
        $PCOservant->insert_by = session()->get("user_id");
        $PCOservant->update_by = session()->get("user_id");
        $PCOservant->insert_time = date("Y-m-d H:i:s");
        $PCOservant->update_time = date("Y-m-d H:i:s");
    }

    public function updating(PCOServants $PCOservant){
        $PCOservant->update_by = session()->get("user_id");
        $PCOservant->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $PCOservant->getDirty();
        $old_data = $PCOservant->getOriginal();
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
            "ref_id" => Helper::encrypt($PCOservant->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOServants "created" event.
     */
    public function created(PCOServants $PCOservant)
    {
        AuditLogs::create([
            "model" => "servant",
            "operation" => "C",
            "ref_id" => Helper::encrypt($PCOservant->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOServants "updated" event.
     */
    public function updated(PCOServants $PCOservant)
    {
        //
    }

    /**
     * Handle the PCOServants "deleted" event.
     */
    public function deleted(PCOServants $PCOservant)
    {
        //
    }

    /**
     * Handle the PCOServants "restored" event.
     */
    public function restored(PCOServants $PCOservant)
    {
        //
    }

    /**
     * Handle the PCOServants "force deleted" event.
     */
    public function forceDeleted(PCOServants $PCOservant)
    {
        //
    }
}
