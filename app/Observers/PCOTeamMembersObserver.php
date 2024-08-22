<?php

namespace App\Observers;

use App\Models\PCOTeamMembers;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCOTeamMembersObserver
{
    public function creating(PCOTeamMembers $pco_team_member){
        $pco_team_member->created_by = session()->get('user_id');
        $pco_team_member->updated_by = session()->get('user_id');
        $pco_team_member->created_at = date('Y-m-d H:i:s');
        $pco_team_member->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(PCOTeamMembers $pco_team_member){
        $pco_team_member->updated_by = session()->get('user_id');
        $pco_team_member->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $pco_team_member->getDirty();
        $old_data = $pco_team_member->getOriginal();
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
            'model' => 'pco_team_members',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($pco_team_member->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOTeamMembers 'created' event.
     */
    public function created(PCOTeamMembers $pco_team_member)
    {
        AuditLogs::create([
            'model' => 'pco_team_members',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($pco_team_member->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOTeamMembers 'updated' event.
     */
    public function updated(PCOTeamMembers $pco_team_member)
    {
        //
    }

    /**
     * Handle the PCOTeamMembers 'deleted' event.
     */
    public function deleted(PCOTeamMembers $pco_team_member)
    {
        //
    }

    /**
     * Handle the PCOTeamMembers 'restored' event.
     */
    public function restored(PCOTeamMembers $pco_team_member)
    {
        //
    }

    /**
     * Handle the PCOTeamMembers 'force deleted' event.
     */
    public function forceDeleted(PCOTeamMembers $pco_team_member)
    {
        //
    }
}
