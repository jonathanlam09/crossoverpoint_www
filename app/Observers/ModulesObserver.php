<?php

namespace App\Observers;

use App\Models\Modules;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class ModulesObserver
{
    public function creating(Modules $module){
        $module->created_by = session()->get('user_id');
        $module->updated_by = session()->get('user_id');
        $module->created_at = date('Y-m-d H:i:s');
        $module->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(Modules $module){
        $module->updated_by = session()->get('user_id');
        $module->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $module->getDirty();
        $old_data = $module->getOriginal();

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
            'model' => 'modules',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($module->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Modules 'created' event.
     */
    public function created(Modules $module)
    {
        AuditLogs::create([
            'model' => 'modules',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($module->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Modules 'updated' event.
     */
    public function updated(Modules $module)
    {
        //
    }

    /**
     * Handle the Modules 'deleted' event.
     */
    public function deleted(Modules $module)
    {
        //
    }

    /**
     * Handle the Modules 'restored' event.
     */
    public function restored(Modules $module)
    {
        //
    }

    /**
     * Handle the Modules 'force deleted' event.
     */
    public function forceDeleted(Modules $module)
    {
        //
    }
}