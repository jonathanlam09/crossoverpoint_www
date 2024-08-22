<?php

namespace App\Observers;

use App\Models\AccountOfferings;
use App\Models\Users;
use App\Models\AuditLogs;
use Helper;
use Exception;

class AccountOfferingsObserver
{
    public function creating(AccountOfferings $offering){
        $offering->created_by = session()->get('user_id');
        $offering->updated_by = session()->get('user_id');
        $offering->created_at = date('Y-m-d H:i:s');
        $offering->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(AccountOfferings $offering){
        $offering->updated_by = session()->get('user_id');
        $offering->updated_at = date('Y-m-d H:i:s');
        
        $prev_dt = [];
        $new_dt = [];
        $new_data = $offering->getDirty();
        $old_data = $offering->getOriginal();

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
            'model' => 'account_offerings',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($offering->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the AccountOfferings 'created' event.
     */
    public function created(AccountOfferings $offering)
    {
        AuditLogs::create([
            'model' => 'account_offerings',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($offering->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the AccountOfferings 'updated' event.
     */
    public function updated(AccountOfferings $offering)
    {
        //
    }

    /**
     * Handle the AccountOfferings 'deleted' event.
     */
    public function deleted(AccountOfferings $offering)
    {
        //
    }

    /**
     * Handle the AccountOfferings 'restored' event.
     */
    public function restored(AccountOfferings $offering)
    {
        //
    }

    /**
     * Handle the AccountOfferings 'force deleted' event.
     */
    public function forceDeleted(AccountOfferings $offering)
    {
        //
    }
}
