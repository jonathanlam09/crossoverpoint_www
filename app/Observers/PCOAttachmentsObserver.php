<?php

namespace App\Observers;

use App\Models\PCOAttachments;
use App\Models\Users;
use App\Models\AuditLogs;
use Helper;
use Exception;

class PCOAttachmentsObserver
{
    public function creating(PCOAttachments $pco_attachment){
        $pco_attachment->insert_by = session()->get("user_id");
        $pco_attachment->update_by = session()->get("user_id");
        $pco_attachment->insert_time = date("Y-m-d H:i:s");
        $pco_attachment->update_time = date("Y-m-d H:i:s");
    }

    public function updating(PCOAttachments $pco_attachment){
        $pco_attachment->update_by = session()->get("user_id");
        $pco_attachment->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $pco_attachment->getDirty();
        $old_data = $pco_attachment->getOriginal();

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
            "model" => "pco_attachment",
            "operation" => "U",
            "ref_id" => Helper::encrypt($pco_attachment->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOAttachments "created" event.
     */
    public function created(PCOAttachments $pco_attachment)
    {
        AuditLogs::create([
            "model" => "pco_attachment",
            "operation" => "C",
            "ref_id" => Helper::encrypt($pco_attachment->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOAttachments "updated" event.
     */
    public function updated(PCOAttachments $pco_attachment)
    {
        //
    }

    /**
     * Handle the PCOAttachments "deleted" event.
     */
    public function deleted(PCOAttachments $pco_attachment)
    {
        //
    }

    /**
     * Handle the PCOAttachments "restored" event.
     */
    public function restored(PCOAttachments $pco_attachment)
    {
        //
    }

    /**
     * Handle the PCOAttachments "force deleted" event.
     */
    public function forceDeleted(PCOAttachments $pco_attachment)
    {
        //
    }
}
