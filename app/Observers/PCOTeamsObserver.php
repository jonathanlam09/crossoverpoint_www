<?php

namespace App\Observers;

use App\Models\PCOTeams;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCOTeamsObserver
{
    public function creating(PCOTeams $pco_team){
        $pco_team->insert_by = session()->get("user_id");
        $pco_team->update_by = session()->get("user_id");
        $pco_team->insert_time = date("Y-m-d H:i:s");
        $pco_team->update_time = date("Y-m-d H:i:s");
    }

    public function updating(PCOTeams $pco_team){
        $pco_team->update_by = session()->get("user_id");
        $pco_team->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $pco_team->getDirty();
        $old_data = $pco_team->getOriginal();
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
            "model" => "PCOTeams",
            "operation" => "U",
            "ref_id" => Helper::encrypt($pco_team->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOTeams "created" event.
     */
    public function created(PCOTeams $pco_team)
    {
        AuditLogs::create([
            "model" => "PCOTeams",
            "operation" => "C",
            "ref_id" => Helper::encrypt($pco_team->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOTeams "updated" event.
     */
    public function updated(PCOTeams $pco_team)
    {
        //
    }

    /**
     * Handle the PCOTeams "deleted" event.
     */
    public function deleted(PCOTeams $pco_team)
    {
        //
    }

    /**
     * Handle the PCOTeams "restored" event.
     */
    public function restored(PCOTeams $pco_team)
    {
        //
    }

    /**
     * Handle the PCOTeams "force deleted" event.
     */
    public function forceDeleted(PCOTeams $pco_team)
    {
        //
    }
}
