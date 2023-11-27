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
        $permission->insert_by = session()->get("user_id");
        $permission->update_by = session()->get("user_id");
        $permission->insert_time = date("Y-m-d H:i:s");
        $permission->update_time = date("Y-m-d H:i:s");
    }

    public function updating(Permissions $permission){
        $permission->update_by = session()->get("user_id");
        $permission->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $permission->getDirty();
        $old_data = $permission->getOriginal();

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
            "model" => "permission",
            "operation" => "U",
            "ref_id" => Helper::encrypt($permission->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Permissions "created" event.
     */
    public function created(Permissions $permission)
    {
        AuditLogs::create([
            "model" => "permission",
            "operation" => "C",
            "ref_id" => Helper::encrypt($permission->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Permissions "updated" event.
     */
    public function updated(Permissions $permission)
    {
        //
    }

    /**
     * Handle the Permissions "deleted" event.
     */
    public function deleted(Permissions $permission)
    {
        //
    }

    /**
     * Handle the Permissions "restored" event.
     */
    public function restored(Permissions $permission)
    {
        //
    }

    /**
     * Handle the Permissions "force deleted" event.
     */
    public function forceDeleted(Permissions $permission)
    {
        //
    }
}
