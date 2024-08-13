<?php

namespace App\Observers;

use App\Models\Sermons;
use App\Models\Users;
use App\Models\AuditLogs;
use Helper;
use Exception;

class SermonsObserver
{
    public function creating(Sermons $sermon){
        $sermon->insert_by = session()->get("user_id");
        $sermon->update_by = session()->get("user_id");
        $sermon->insert_time = date("Y-m-d H:i:s");
        $sermon->update_time = date("Y-m-d H:i:s");
    }

    public function updating(Sermons $sermon){
        $sermon->update_by = session()->get("user_id");
        $sermon->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $sermon->getDirty();
        $old_data = $sermon->getOriginal();
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
            "model" => "sermon",
            "operation" => "U",
            "ref_id" => Helper::encrypt($sermon->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Sermons "created" event.
     */
    public function created(Sermons $sermon)
    {
        AuditLogs::create([
            "model" => "sermon",
            "operation" => "C",
            "ref_id" => Helper::encrypt($sermon->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Sermons "updated" event.
     */
    public function updated(Sermons $sermon)
    {
        //
    }

    /**
     * Handle the Sermons "deleted" event.
     */
    public function deleted(Sermons $sermon)
    {
        //
    }

    /**
     * Handle the Sermons "restored" event.
     */
    public function restored(Sermons $sermon)
    {
        //
    }

    /**
     * Handle the Sermons "force deleted" event.
     */
    public function forceDeleted(Sermons $sermon)
    {
        //
    }
}
