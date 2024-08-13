<?php

namespace App\Observers;

use App\Models\PCOSongArrangements;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCOSongArrangementsObserver
{
    public function creating(PCOSongArrangements $pco_song_arrangements){
        $pco_song_arrangements->insert_by = session()->get("user_id");
        $pco_song_arrangements->insert_time = date("Y-m-d H:i:s");
    }

    public function updating(PCOSongArrangements $pco_song_arrangements){
        $prev_dt = [];
        $new_dt = [];
        $new_data = $pco_song_arrangements->getDirty();
        $old_data = $pco_song_arrangements->getOriginal();
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
            "model" => "pco_song_arrangements",
            "operation" => "U",
            "ref_id" => Helper::encrypt($pco_song_arrangements->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOSongArrangements "created" event.
     */
    public function created(PCOSongArrangements $pco_song_arrangements)
    {
        AuditLogs::create([
            "model" => "pco_song_arrangements",
            "operation" => "C",
            "ref_id" => Helper::encrypt($pco_song_arrangements->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOSongArrangements "updated" event.
     */
    public function updated(PCOSongArrangements $pco_song_arrangements)
    {
        //
    }

    /**
     * Handle the PCOSongArrangements "deleted" event.
     */
    public function deleted(PCOSongArrangements $pco_song_arrangements)
    {
        //
    }

    /**
     * Handle the PCOSongArrangements "restored" event.
     */
    public function restored(PCOSongArrangements $pco_song_arrangements)
    {
        //
    }

    /**
     * Handle the PCOSongArrangements "force deleted" event.
     */
    public function forceDeleted(PCOSongArrangements $pco_song_arrangements)
    {
        //
    }
}
