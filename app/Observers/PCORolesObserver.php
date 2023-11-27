<?php

namespace App\Observers;

use App\Models\PCORoles;
use App\Models\Users;
use App\Models\AuditLogs;
use Helper;
use Exception;

class PCORolesObserver
{
    public function creating(PCORoles $pco_role){
        $pco_role->insert_by = session()->get("user_id");
        $pco_role->update_by = session()->get("user_id");
        $pco_role->insert_time = date("Y-m-d H:i:s");
        $pco_role->update_time = date("Y-m-d H:i:s");
    }

    public function updating(PCORoles $pco_role){
        $pco_role->update_by = session()->get("user_id");
        $pco_role->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $pco_role->getDirty();
        $old_data = $pco_role->getOriginal();

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
            "model" => "pco_role",
            "operation" => "U",
            "ref_id" => Helper::encrypt($pco_role->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCORoles "created" event.
     */
    public function created(PCORoles $pco_role)
    {
        AuditLogs::create([
            "model" => "pco_role",
            "operation" => "C",
            "ref_id" => Helper::encrypt($pco_role->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCORoles "updated" event.
     */
    public function updated(PCORoles $pco_role)
    {
        //
    }

    /**
     * Handle the PCORoles "deleted" event.
     */
    public function deleted(PCORoles $pco_role)
    {
        //
    }

    /**
     * Handle the PCORoles "restored" event.
     */
    public function restored(PCORoles $pco_role)
    {
        //
    }

    /**
     * Handle the PCORoles "force deleted" event.
     */
    public function forceDeleted(PCORoles $pco_role)
    {
        //
    }
}
