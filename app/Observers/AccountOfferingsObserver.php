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
        $offering->insert_by = session()->get("user_id");
        $offering->update_by = session()->get("user_id");
        $offering->insert_time = date("Y-m-d H:i:s");
        $offering->update_time = date("Y-m-d H:i:s");
    }

    public function updating(AccountOfferings $offering){
        $offering->update_by = session()->get("user_id");
        $offering->update_time = date("Y-m-d H:i:s");
        
        $prev_dt = [];
        $new_dt = [];
        $new_data = $offering->getDirty();
        $old_data = $offering->getOriginal();

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
            "model" => "offering",
            "operation" => "U",
            "ref_id" => Helper::encrypt($offering->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the AccountOfferings "created" event.
     */
    public function created(AccountOfferings $offering)
    {
        AuditLogs::create([
            "model" => "offering",
            "operation" => "C",
            "ref_id" => Helper::encrypt($offering->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the AccountOfferings "updated" event.
     */
    public function updated(AccountOfferings $offering)
    {
        //
    }

    /**
     * Handle the AccountOfferings "deleted" event.
     */
    public function deleted(AccountOfferings $offering)
    {
        //
    }

    /**
     * Handle the AccountOfferings "restored" event.
     */
    public function restored(AccountOfferings $offering)
    {
        //
    }

    /**
     * Handle the AccountOfferings "force deleted" event.
     */
    public function forceDeleted(AccountOfferings $offering)
    {
        //
    }
}
