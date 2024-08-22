<?php

namespace App\Observers;

use App\Models\AuditLogs;
use App\Models\UserUnavailability;
use App\Models\Users;
use Helper;
use Exception;

class UserUnavailabilityObserver
{
    public function creating(UserUnavailability $unavailability){
        $unavailability->created_by = session()->get('user_id');
        $unavailability->updated_by = session()->get('user_id');
        $unavailability->created_at = date('Y-m-d H:i:s');
        $unavailability->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(UserUnavailability $unavailability){
        $unavailability->updated_by = session()->get('user_id');
        $unavailability->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $unavailability->getDirty();
        $old_data = $unavailability->getOriginal();

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
            'model' => 'user_unavailability',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($unavailability->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the UserUnavailability 'created' event.
     */
    public function created(UserUnavailability $unavailability)
    {
        AuditLogs::create([
            'model' => 'user_unavailability',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($unavailability->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the UserUnavailability 'updated' event.
     */
    public function updated(UserUnavailability $unavailability)
    {
        //
    }

    /**
     * Handle the UserUnavailability 'deleted' event.
     */
    public function deleted(UserUnavailability $unavailability)
    {
        //
    }

    /**
     * Handle the UserUnavailability 'restored' event.
     */
    public function restored(UserUnavailability $unavailability)
    {
        //
    }

    /**
     * Handle the UserUnavailability 'force deleted' event.
     */
    public function forceDeleted(UserUnavailability $unavailability)
    {
        //
    }
}
