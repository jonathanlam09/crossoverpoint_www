<?php

namespace App\Observers;

use App\Models\PCO;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCOObserver
{
    public function creating(PCO $pco){
        $pco->created_by = session()->get('user_id');
        $pco->updated_by = session()->get('user_id');
        $pco->created_at = date('Y-m-d H:i:s');
        $pco->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(PCO $pco){
        $pco->updated_by = session()->get('user_id');
        $pco->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $pco->getDirty();
        $old_data = $pco->getOriginal();
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
            'model' => 'pco',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($pco->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCO 'created' event.
     */
    public function created(PCO $pco)
    {
        AuditLogs::create([
            'model' => 'pco',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($pco->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCO 'updated' event.
     */
    public function updated(PCO $pco)
    {
        //
    }

    /**
     * Handle the PCO 'deleted' event.
     */
    public function deleted(PCO $pco)
    {
        //
    }

    /**
     * Handle the PCO 'restored' event.
     */
    public function restored(PCO $pco)
    {
        //
    }

    /**
     * Handle the PCO 'force deleted' event.
     */
    public function forceDeleted(PCO $pco)
    {
        //
    }
}
