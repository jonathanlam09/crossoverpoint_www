<?php

namespace App\Observers;

use App\Models\PCORequests;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCORequestsObserver
{
    public function creating(PCORequests $pco_request){
        $pco_request->insert_by = session()->get("user_id");
        $pco_request->update_by = session()->get("user_id");
        $pco_request->insert_time = date("Y-m-d H:i:s");
        $pco_request->update_time = date("Y-m-d H:i:s");
    }

    public function updating(PCORequests $pco_request){
        $pco_request->update_by = session()->get("user_id");
        $pco_request->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $pco_request->getDirty();
        $old_data = $pco_request->getOriginal();

        foreach($new_data as $key=>$row){
            if($key != "update_by" && $key != "update_time" && $key != "active"){
                if($key == "user_id"){
                    $old_user = Users::where([
                        "id" => $row,
                        "active" => 1
                    ])->first();
                    if(!$old_user){
                        throw new Exception("User not found!");
                    }
                    $new_user = Users::where([
                        "id" => $row,
                        "active" => 1
                    ])->first();
                    if(!$new_user){
                        throw new Exception("User not found!");
                    }
                    $prev_dt["user"] = $old_user->getFullname();
                    $new_dt["user"] =  $new_user->getFullname();
                }else{
                    $old = $old_data[$key];
                    $prev_dt[$key] = $old;
                    $new_dt[$key] =  $row;
                }
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
            "model" => "pco_request",
            "operation" => "U",
            "ref_id" => Helper::encrypt($pco_request->pco_id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCORequests "created" event.
     */
    public function created(PCORequests $pco_request)
    {
        AuditLogs::create([
            "model" => "pco_request",
            "operation" => "C",
            "ref_id" => Helper::encrypt($pco_request->pco_id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCORequests "updated" event.
     */
    public function updated(PCORequests $pco_request)
    {
        //
    }

    /**
     * Handle the PCORequests "deleted" event.
     */
    public function deleted(PCORequests $pco_request)
    {
        //
    }

    /**
     * Handle the PCORequests "restored" event.
     */
    public function restored(PCORequests $pco_request)
    {
        //
    }

    /**
     * Handle the PCORequests "force deleted" event.
     */
    public function forceDeleted(PCORequests $pco_request)
    {
        //
    }
}
