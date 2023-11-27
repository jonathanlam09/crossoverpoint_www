<?php

namespace App\Observers;

use App\Models\Songs;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class SongsObserver
{
    public function creating(Songs $song){
        $song->insert_by = session()->get("user_id");
        $song->update_by = session()->get("user_id");
        $song->insert_time = date("Y-m-d H:i:s");
        $song->update_time = date("Y-m-d H:i:s");
    }

    public function updating(Songs $song){
        $song->update_by = session()->get("user_id");
        $song->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $song->getDirty();
        $old_data = $song->getOriginal();

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
            "model" => "song",
            "operation" => "U",
            "ref_id" => Helper::encrypt($song->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Songs "created" event.
     */
    public function created(Songs $song)
    {
        AuditLogs::create([
            "model" => "song",
            "operation" => "C",
            "ref_id" => Helper::encrypt($song->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Songs "updated" event.
     */
    public function updated(Songs $song)
    {
        //
    }

    /**
     * Handle the Songs "deleted" event.
     */
    public function deleted(Songs $song)
    {
        //
    }

    /**
     * Handle the Songs "restored" event.
     */
    public function restored(Songs $song)
    {
        //
    }

    /**
     * Handle the Songs "force deleted" event.
     */
    public function forceDeleted(Songs $song)
    {
        //
    }
}
