<?php

namespace App\Observers;

use App\Models\SongAttachments;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class SongAttachmentsObserver
{
    public function creating(SongAttachments $song_attachment){
        $song_attachment->insert_by = session()->get("user_id");
        $song_attachment->update_by = session()->get("user_id");
        $song_attachment->insert_time = date("Y-m-d H:i:s");
        $song_attachment->update_time = date("Y-m-d H:i:s");
    }

    public function updating(SongAttachments $song_attachment){
        $song_attachment->update_by = session()->get("user_id");
        $song_attachment->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $song_attachment->getDirty();
        $old_data = $song_attachment->getOriginal();
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
            "model" => "song_attachment",
            "operation" => "U",
            "ref_id" => Helper::encrypt($song_attachment->path),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the SongAttachments "created" event.
     */
    public function created(SongAttachments $song_attachment)
    {
        AuditLogs::create([
            "model" => "song_attachment",
            "operation" => "C",
            "ref_id" => Helper::encrypt($song_attachment->path),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the SongAttachments "updated" event.
     */
    public function updated(SongAttachments $song_attachment)
    {
        //
    }

    /**
     * Handle the SongAttachments "deleted" event.
     */
    public function deleted(SongAttachments $song_attachment)
    {
        //
    }

    /**
     * Handle the SongAttachments "restored" event.
     */
    public function restored(SongAttachments $song_attachment)
    {
        //
    }

    /**
     * Handle the SongAttachments "force deleted" event.
     */
    public function forceDeleted(SongAttachments $song_attachment)
    {
        //
    }
}
