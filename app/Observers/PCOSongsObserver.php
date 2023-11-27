<?php

namespace App\Observers;

use App\Models\PCOSongs;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCOSongsObserver
{
    public function creating(PCOSongs $pco_song){
        $pco_song->insert_by = session()->get("user_id");
        $pco_song->update_by = session()->get("user_id");
        $pco_song->insert_time = date("Y-m-d H:i:s");
        $pco_song->update_time = date("Y-m-d H:i:s");
    }

    public function updating(PCOSongs $pco_song){
        $pco_song->update_by = session()->get("user_id");
        $pco_song->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $pco_song->getDirty();
        $old_data = $pco_song->getOriginal();

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
            "model" => "pco_song",
            "operation" => "U",
            "ref_id" => Helper::encrypt($pco_song->song_id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOSongs "created" event.
     */
    public function created(PCOSongs $pco_song)
    {
        AuditLogs::create([
            "model" => "pco_song",
            "operation" => "C",
            "ref_id" => Helper::encrypt($pco_song->song_id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOSongs "updated" event.
     */
    public function updated(PCOSongs $pco_song)
    {
        //
    }

    /**
     * Handle the PCOSongs "deleted" event.
     */
    public function deleted(PCOSongs $pco_song)
    {
        //
    }

    /**
     * Handle the PCOSongs "restored" event.
     */
    public function restored(PCOSongs $pco_song)
    {
        //
    }

    /**
     * Handle the PCOSongs "force deleted" event.
     */
    public function forceDeleted(PCOSongs $pco_song)
    {
        //
    }
}
