<?php

namespace App\Observers;

use App\Models\PCOTeams;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCOTeamsObserver
{
    public function creating(PCOTeams $team){
        $team->created_by = session()->get('user_id');
        $team->updated_by = session()->get('user_id');
        $team->created_at = date('Y-m-d H:i:s');
        $team->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(PCOTeams $team){
        $team->updated_by = session()->get('user_id');
        $team->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $team->getDirty();
        $old_data = $team->getOriginal();
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
            'model' => 'pco_teams',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($team->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOTeams 'created' event.
     */
    public function created(PCOTeams $team)
    {
        AuditLogs::create([
            'model' => 'pco_teams',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($team->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOTeams 'updated' event.
     */
    public function updated(PCOTeams $team)
    {
        //
    }

    /**
     * Handle the PCOTeams 'deleted' event.
     */
    public function deleted(PCOTeams $team)
    {
        //
    }

    /**
     * Handle the PCOTeams 'restored' event.
     */
    public function restored(PCOTeams $team)
    {
        //
    }

    /**
     * Handle the PCOTeams 'force deleted' event.
     */
    public function forceDeleted(PCOTeams $team)
    {
        //
    }
}
