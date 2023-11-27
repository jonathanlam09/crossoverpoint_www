<?php

namespace App\Observers;

use App\Models\Events;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class EventsObserver
{
    public function creating(Events $event){
        $event->insert_by = session()->get("user_id");
        $event->update_by = session()->get("user_id");
        $event->insert_time = date("Y-m-d H:i:s");
        $event->update_time = date("Y-m-d H:i:s");
    }

    public function updating(Events $event){
        $event->update_by = session()->get("user_id");
        $event->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $event->getDirty();
        $old_data = $event->getOriginal();

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
            "model" => "event",
            "operation" => "U",
            "ref_id" => Helper::encrypt($event->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Events "created" event.
     */
    public function created(Events $event)
    {
        AuditLogs::create([
            "model" => "event",
            "operation" => "C",
            "ref_id" => Helper::encrypt($event->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Events "updated" event.
     */
    public function updated(Events $event)
    {
        // 
    }

    /**
     * Handle the Events "deleted" event.
     */
    public function deleted(Events $event)
    {
        //
    }

    /**
     * Handle the Events "restored" event.
     */
    public function restored(Events $event)
    {
        //
    }

    /**
     * Handle the Events "force deleted" event.
     */
    public function forceDeleted(Events $event)
    {
        //
    }
}
