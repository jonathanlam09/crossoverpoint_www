<?php

namespace App\Observers;

use App\Models\GroupMembers;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class GroupMembersObserver
{
    public function creating(GroupMembers $group_member){
        $group_member->insert_by = session()->get("user_id");
        $group_member->update_by = session()->get("user_id");
        $group_member->insert_time = date("Y-m-d H:i:s");
        $group_member->update_time = date("Y-m-d H:i:s");
    }

    public function updating(GroupMembers $group_member){
        $group_member->update_by = session()->get("user_id");
        $group_member->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $group_member->getDirty();
        $old_data = $group_member->getOriginal();

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
            "ref_id" => Helper::encrypt($group_member->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the GroupMembers "created" GroupMember.
     */
    public function created(GroupMembers $group_member)
    {
        AuditLogs::create([
            "model" => "event",
            "operation" => "C",
            "ref_id" => Helper::encrypt($group_member->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the GroupMembers "updated" GroupMember.
     */
    public function updated(GroupMembers $group_member)
    {
        //
    }

    /**
     * Handle the GroupMembers "deleted" GroupMember.
     */
    public function deleted(GroupMembers $group_member)
    {
        //
    }

    /**
     * Handle the GroupMembers "restored" GroupMember.
     */
    public function restored(GroupMembers $group_member)
    {
        //
    }

    /**
     * Handle the GroupMembers "force deleted" GroupMember.
     */
    public function forceDeleted(GroupMembers $group_member)
    {
        //
    }
}
