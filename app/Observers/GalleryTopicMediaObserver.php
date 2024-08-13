<?php

namespace App\Observers;

use App\Models\GalleryTopicMedia;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class GalleryTopicMediaObserver
{
    public function creating(GalleryTopicMedia $media){
        $media->insert_by = session()->get("user_id");
        $media->update_by = session()->get("user_id");
        $media->insert_time = date("Y-m-d H:i:s");
        $media->update_time = date("Y-m-d H:i:s");
    }

    public function updating(GalleryTopicMedia $media){
        $media->update_by = session()->get("user_id");
        $media->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $media->getDirty();
        $old_data = $media->getOriginal();

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
            "model" => "gallery_topic_media",
            "operation" => "U",
            "ref_id" => Helper::encrypt($media->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the GalleryTopicMedia "created" event.
     */
    public function created(GalleryTopicMedia $media)
    {
        AuditLogs::create([
            "model" => "gallery_topic_Media",
            "operation" => "C",
            "ref_id" => Helper::encrypt($media->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the GalleryTopicMedia "updated" event.
     */
    public function updated(GalleryTopicMedia $media)
    {
        // 
    }

    /**
     * Handle the GalleryTopicMedia "deleted" event.
     */
    public function deleted(GalleryTopicMedia $media)
    {
        //
    }

    /**
     * Handle the GalleryTopicMedia "restored" event.
     */
    public function restored(GalleryTopicMedia $media)
    {
        //
    }

    /**
     * Handle the GalleryTopicMedia "force deleted" event.
     */
    public function forceDeleted(GalleryTopicMedia $media)
    {
        //
    }
}
