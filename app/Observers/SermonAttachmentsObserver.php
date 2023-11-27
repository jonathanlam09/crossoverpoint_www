<?php

namespace App\Observers;

use App\Models\SermonAttachments;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class SermonAttachmentsObserver
{
    public function creating(SermonAttachments $sermon_attachment){
        $sermon_attachment->insert_by = session()->get("user_id");
        $sermon_attachment->update_by = session()->get("user_id");
        $sermon_attachment->insert_time = date("Y-m-d H:i:s");
        $sermon_attachment->update_time = date("Y-m-d H:i:s");
    }

    public function updating(SermonAttachments $sermon_attachment){
        $sermon_attachment->update_by = session()->get("user_id");
        $sermon_attachment->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $sermon_attachment->getDirty();
        $old_data = $sermon_attachment->getOriginal();

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
            "model" => "sermon_attachment",
            "operation" => "U",
            "ref_id" => Helper::encrypt($sermon_attachment->path),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the SermonAttachments "created" event.
     */
    public function created(SermonAttachments $sermon_attachment)
    {
        AuditLogs::create([
            "model" => "sermon_attachment",
            "operation" => "C",
            "ref_id" => Helper::encrypt($sermon_attachment->path),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the SermonAttachments "updated" event.
     */
    public function updated(SermonAttachments $sermon_attachment)
    {
        //
    }

    /**
     * Handle the SermonAttachments "deleted" event.
     */
    public function deleted(SermonAttachments $sermon_attachment)
    {
        //
    }

    /**
     * Handle the SermonAttachments "restored" event.
     */
    public function restored(SermonAttachments $sermon_attachment)
    {
        //
    }

    /**
     * Handle the SermonAttachments "force deleted" event.
     */
    public function forceDeleted(SermonAttachments $sermon_attachment)
    {
        //
    }
}
