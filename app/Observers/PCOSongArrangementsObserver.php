<?php

namespace App\Observers;

use App\Models\PCOSongArrangements;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCOSongArrangementsObserver
{
    public function creating(PCOSongArrangements $arrangement){
        $arrangement->created_by = session()->get('user_id');
        $arrangement->created_at = date('Y-m-d H:i:s');
    }

    public function updating(PCOSongArrangements $arrangement){
        $prev_dt = [];
        $new_dt = [];
        $new_data = $arrangement->getDirty();
        $old_data = $arrangement->getOriginal();
        foreach($new_data as $key=>$row){
            if($key != 'updated_by' && $key != 'updated_at'){
                $old = $old_data[$key];
                $prev_dt[$key] = $old;
                $new_dt[$key] =  $row;
            }
        }
        $user = Users::where([
            'id' => session()->get('user_id'),
            'active' => 1
        ])->first();
        if(!$user){
            throw new Exception('User not found!');
        }
        $data = [
            'prev_data' => json_encode($prev_dt),
            'new_data' => json_encode($new_dt),
            'model' => 'pco_song_arrangements',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($arrangement->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOSongArrangements 'created' event.
     */
    public function created(PCOSongArrangements $arrangement)
    {
        AuditLogs::create([
            'model' => 'pco_song_arrangements',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($arrangement->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOSongArrangements 'updated' event.
     */
    public function updated(PCOSongArrangements $arrangement)
    {
        //
    }

    /**
     * Handle the PCOSongArrangements 'deleted' event.
     */
    public function deleted(PCOSongArrangements $arrangement)
    {
        //
    }

    /**
     * Handle the PCOSongArrangements 'restored' event.
     */
    public function restored(PCOSongArrangements $arrangement)
    {
        //
    }

    /**
     * Handle the PCOSongArrangements 'force deleted' event.
     */
    public function forceDeleted(PCOSongArrangements $arrangement)
    {
        //
    }
}
