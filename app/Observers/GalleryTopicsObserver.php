<?php

namespace App\Observers;

use App\Models\GalleryTopics;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class GalleryTopicsObserver
{
    public function creating(GalleryTopics $topic){
        $topic->insert_by = session()->get("user_id");
        $topic->update_by = session()->get("user_id");
        $topic->insert_time = date("Y-m-d H:i:s");
        $topic->update_time = date("Y-m-d H:i:s");
    }

    public function updating(GalleryTopics $topic){
        $topic->update_by = session()->get("user_id");
        $topic->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $topic->getDirty();
        $old_data = $topic->getOriginal();

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
            "model" => "gallery_topics",
            "operation" => "U",
            "ref_id" => Helper::encrypt($topic->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the GalleryTopics "created" event.
     */
    public function created(GalleryTopics $topic)
    {
        AuditLogs::create([
            "model" => "gallery_topics",
            "operation" => "C",
            "ref_id" => Helper::encrypt($topic->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the GalleryTopics "updated" event.
     */
    public function updated(GalleryTopics $topic)
    {
        // 
    }

    /**
     * Handle the GalleryTopics "deleted" event.
     */
    public function deleted(GalleryTopics $topic)
    {
        //
    }

    /**
     * Handle the GalleryTopics "restored" event.
     */
    public function restored(GalleryTopics $topic)
    {
        //
    }

    /**
     * Handle the GalleryTopics "force deleted" event.
     */
    public function forceDeleted(GalleryTopics $topic)
    {
        //
    }
}
