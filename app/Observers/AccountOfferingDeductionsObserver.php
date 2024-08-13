<?php

namespace App\Observers;

use App\Models\AccountOfferingDeductions;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class AccountOfferingDeductionsObserver
{
    public function creating(AccountOfferingDeductions $offering_deduction){
        $offering_deduction->insert_by = session()->get("user_id");
        $offering_deduction->insert_time = date("Y-m-d H:i:s");
    }

    public function updating(AccountOfferingDeductions $offering_deduction){
        $prev_dt = [];
        $new_dt = [];
        $new_data = $offering_deduction->getDirty();
        $old_data = $offering_deduction->getOriginal();

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
            "model" => "account_offering_deductions",
            "operation" => "U",
            "ref_id" => Helper::encrypt($offering_deduction->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the AccountOfferingDeductions "created" event.
     */
    public function created(AccountOfferingDeductions $offering_deduction): void
    {
        AuditLogs::create([
            "model" => "account_offering_deductions",
            "operation" => "C",
            "ref_id" => Helper::encrypt($offering_deduction->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the AccountOfferingDeductions "updated" event.
     */
    public function updated(AccountOfferingDeductions $offering_deduction): void
    {
        //
    }

    /**
     * Handle the AccountOfferingDeductions "deleted" event.
     */
    public function deleted(AccountOfferingDeductions $offering_deduction): void
    {
        //
    }

    /**
     * Handle the AccountOfferingDeductions "restored" event.
     */
    public function restored(AccountOfferingDeductions $offering_deduction): void
    {
        //
    }

    /**
     * Handle the AccountOfferingDeductions "force deleted" event.
     */
    public function forceDeleted(AccountOfferingDeductions $offering_deduction): void
    {
        //
    }
}
