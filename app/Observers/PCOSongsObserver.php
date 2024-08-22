<?php

namespace App\Observers;

use App\Models\PCOSongs;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCOSongsObserver
{
    public function creating(PCOSongs $song){
        $song->created_by = session()->get('user_id');
        $song->updated_by = session()->get('user_id');
        $song->created_at = date('Y-m-d H:i:s');
        $song->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(PCOSongs $song){
        $song->updated_by = session()->get('user_id');
        $song->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $song->getDirty();
        $old_data = $song->getOriginal();

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
            'model' => 'pco_songs',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($song->song_id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOSongs 'created' event.
     */
    public function created(PCOSongs $song)
    {
        AuditLogs::create([
            'model' => 'pco_songs',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($song->song_id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOSongs 'updated' event.
     */
    public function updated(PCOSongs $song)
    {
        //
    }

    /**
     * Handle the PCOSongs 'deleted' event.
     */
    public function deleted(PCOSongs $song)
    {
        //
    }

    /**
     * Handle the PCOSongs 'restored' event.
     */
    public function restored(PCOSongs $song)
    {
        //
    }

    /**
     * Handle the PCOSongs 'force deleted' event.
     */
    public function forceDeleted(PCOSongs $song)
    {
        //
    }
}
