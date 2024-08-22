<?php

namespace App\Observers;

use App\Models\Permissions;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PermissionsObserver
{
    public function creating(Permissions $permission){
        $permission->created_by = session()->get('user_id');
        $permission->updated_by = session()->get('user_id');
        $permission->created_at = date('Y-m-d H:i:s');
        $permission->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(Permissions $permission){
        $permission->updated_by = session()->get('user_id');
        $permission->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $permission->getDirty();
        $old_data = $permission->getOriginal();

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
            'model' => 'permissions',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($permission->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Permissions 'created' event.
     */
    public function created(Permissions $permission)
    {
        AuditLogs::create([
            'model' => 'permissions',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($permission->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Permissions 'updated' event.
     */
    public function updated(Permissions $permission)
    {
        //
    }

    /**
     * Handle the Permissions 'deleted' event.
     */
    public function deleted(Permissions $permission)
    {
        //
    }

    /**
     * Handle the Permissions 'restored' event.
     */
    public function restored(Permissions $permission)
    {
        //
    }

    /**
     * Handle the Permissions 'force deleted' event.
     */
    public function forceDeleted(Permissions $permission)
    {
        //
    }
}
