<?php

namespace App\Observers;

use App\Models\GroupMembers;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class GroupMembersObserver
{
    public function creating(GroupMembers $member){
        $member->created_by = session()->get('user_id');
        $member->updated_by = session()->get('user_id');
        $member->created_at = date('Y-m-d H:i:s');
        $member->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(GroupMembers $member){
        $member->updated_by = session()->get('user_id');
        $member->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $member->getDirty();
        $old_data = $member->getOriginal();

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
            'model' => 'group_members',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($member->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the GroupMembers 'created' GroupMember.
     */
    public function created(GroupMembers $member)
    {
        AuditLogs::create([
            'model' => 'group_members',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($member->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the GroupMembers 'updated' GroupMember.
     */
    public function updated(GroupMembers $member)
    {
        //
    }

    /**
     * Handle the GroupMembers 'deleted' GroupMember.
     */
    public function deleted(GroupMembers $member)
    {
        //
    }

    /**
     * Handle the GroupMembers 'restored' GroupMember.
     */
    public function restored(GroupMembers $member)
    {
        //
    }

    /**
     * Handle the GroupMembers 'force deleted' GroupMember.
     */
    public function forceDeleted(GroupMembers $member)
    {
        //
    }
}
