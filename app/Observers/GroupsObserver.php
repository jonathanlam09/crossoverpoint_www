<?php

namespace App\Observers;

use App\Models\Groups;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class GroupsObserver
{
    public function creating(Groups $group){
        $group->created_by = session()->get('user_id');
        $group->updated_by = session()->get('user_id');
        $group->created_at = date('Y-m-d H:i:s');
        $group->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(Groups $group){
        $group->updated_by = session()->get('user_id');
        $group->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $group->getDirty();
        $old_data = $group->getOriginal();

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
            'ref_id' => Helper::encrypt($group->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Groups 'created' Group.
     */
    public function created(Groups $group)
    {
        AuditLogs::create([
            'model' => 'group_members',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($group->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Groups 'updated' Group.
     */
    public function updated(Groups $group)
    {
        //
    }

    /**
     * Handle the Groups 'deleted' Group.
     */
    public function deleted(Groups $group)
    {
        //
    }

    /**
     * Handle the Groups 'restored' Group.
     */
    public function restored(Groups $group)
    {
        //
    }

    /**
     * Handle the Groups 'force deleted' Group.
     */
    public function forceDeleted(Groups $group)
    {
        //
    }
}
