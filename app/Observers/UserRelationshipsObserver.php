<?php

namespace App\Observers;

use App\Models\AuditLogs;
use App\Models\UserRelationships;
use App\Models\Users;
use Helper;
use Exception;

class UserRelationshipsObserver
{
    public function creating(UserRelationships $relationship){
        $relationship->created_at = date('Y-m-d H:i:s');
        $relationship->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(UserRelationships $relationship){
        $relationship->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $relationship->getDirty();
        $old_data = $relationship->getOriginal();

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
            'model' => 'user_relationships',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($relationship->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the UserRelationships 'created' event.
     */
    public function created(UserRelationships $relationship)
    {
        AuditLogs::create([
            'model' => 'user_relationships',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($relationship->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the UserRelationships 'updated' event.
     */
    public function updated(UserRelationships $relationship)
    {
        //
    }

    /**
     * Handle the UserRelationships 'deleted' event.
     */
    public function deleted(UserRelationships $relationship)
    {
        //
    }

    /**
     * Handle the UserRelationships 'restored' event.
     */
    public function restored(UserRelationships $relationship)
    {
        //
    }

    /**
     * Handle the UserRelationships 'force deleted' event.
     */
    public function forceDeleted(UserRelationships $relationship)
    {
        //
    }
}
