<?php

namespace App\Observers;

use App\Models\PermissionRoles;
use App\Models\Users;
use App\Models\AuditLogs;
use Helper;
use Exception;

class PermissionRolesObserver
{
    public function creating(PermissionRoles $permission_role){
        $permission_role->created_by = session()->get('user_id');
        $permission_role->updated_by = session()->get('user_id');
        $permission_role->created_at = date('Y-m-d H:i:s');
        $permission_role->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(PermissionRoles $permission_role){
        $permission_role->updated_by = session()->get('user_id');
        $permission_role->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $permission_role->getDirty();
        $old_data = $permission_role->getOriginal();

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
            'model' => 'permission_roles',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($permission_role->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PermissionRoles 'created' event.
     */
    public function created(PermissionRoles $permission_role)
    {
        AuditLogs::create([
            'model' => 'permission_roles',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($permission_role->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PermissionRoles 'updated' event.
     */
    public function updated(PermissionRoles $permission_role)
    {
        //
    }

    /**
     * Handle the PermissionRoles 'deleted' event.
     */
    public function deleted(PermissionRoles $permission_role)
    {
        //
    }

    /**
     * Handle the PermissionRoles 'restored' event.
     */
    public function restored(PermissionRoles $permission_role)
    {
        //
    }

    /**
     * Handle the PermissionRoles 'force deleted' event.
     */
    public function forceDeleted(PermissionRoles $permission_role)
    {
        //
    }
}
