<?php

namespace App\Observers;

use App\Models\Highlights;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class HighlightsObserver
{
    public function creating(Highlights $highlight){
        $highlight->insert_by = session()->get("user_id");
        $highlight->update_by = session()->get("user_id");
        $highlight->insert_time = date("Y-m-d H:i:s");
        $highlight->update_time = date("Y-m-d H:i:s");
    }

    public function updating(Highlights $highlight){
        $highlight->update_by = session()->get("user_id");
        $highlight->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $highlight->getDirty();
        $old_data = $highlight->getOriginal();

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
            "model" => "highlight",
            "operation" => "U",
            "ref_id" => Helper::encrypt($highlight->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Highlights "created" event.
     */
    public function created(Highlights $highlight)
    {
        AuditLogs::create([
            "model" => "highlight",
            "operation" => "C",
            "ref_id" => Helper::encrypt($highlight->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Highlights "updated" event.
     */
    public function updated(Highlights $highlight)
    {
        //
    }

    /**
     * Handle the Highlights "deleted" event.
     */
    public function deleted(Highlights $highlight)
    {
        //
    }

    /**
     * Handle the Highlights "restored" event.
     */
    public function restored(Highlights $highlight)
    {
        //
    }

    /**
     * Handle the Highlights "force deleted" event.
     */
    public function forceDeleted(Highlights $highlight)
    {
        //
    }
}