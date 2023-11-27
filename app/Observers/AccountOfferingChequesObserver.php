<?php

namespace App\Observers;

use App\Models\AccountOfferingCheques;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class AccountOfferingChequesObserver
{
    public function creating(AccountOfferingCheques $offering_cheque){
        $offering_cheque->insert_by = session()->get("user_id");
        $offering_cheque->update_by = session()->get("user_id");
        $offering_cheque->insert_time = date("Y-m-d H:i:s");
        $offering_cheque->update_time = date("Y-m-d H:i:s");
    }

    public function updating(AccountOfferingCheques $offering_cheque){
        $offering_cheque->update_by = session()->get("user_id");
        $offering_cheque->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $offering_cheque->getDirty();
        $old_data = $offering_cheque->getOriginal();

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
            "model" => "claim",
            "operation" => "U",
            "ref_id" => Helper::encrypt($offering_cheque->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the AccountOfferingCheques "created" event.
     */
    public function created(AccountOfferingCheques $offering_cheque): void
    {
        AuditLogs::create([
            "model" => "offering_cheque",
            "operation" => "C",
            "ref_id" => Helper::encrypt($offering_cheque->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the AccountOfferingCheques "updated" event.
     */
    public function updated(AccountOfferingCheques $offering_cheque): void
    {
        //
    }

    /**
     * Handle the AccountOfferingCheques "deleted" event.
     */
    public function deleted(AccountOfferingCheques $offering_cheque): void
    {
        //
    }

    /**
     * Handle the AccountOfferingCheques "restored" event.
     */
    public function restored(AccountOfferingCheques $offering_cheque): void
    {
        //
    }

    /**
     * Handle the AccountOfferingCheques "force deleted" event.
     */
    public function forceDeleted(AccountOfferingCheques $offering_cheque): void
    {
        //
    }
}
