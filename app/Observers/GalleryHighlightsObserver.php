<?php

namespace App\Observers;

use App\Models\GalleryHighlights;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class GalleryHighlightsObserver
{
    public function creating(GalleryHighlights $highlight){
        $highlight->insert_by = session()->get("user_id");
        $highlight->update_by = session()->get("user_id");
        $highlight->insert_time = date("Y-m-d H:i:s");
        $highlight->update_time = date("Y-m-d H:i:s");
    }

    public function updating(GalleryHighlights $highlight){
        $highlight->update_by = session()->get("user_id");
        $highlight->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $highlight->getDirty();
        $old_data = $highlight->getOriginal();

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
            "model" => "gallery_highlights",
            "operation" => "U",
            "ref_id" => Helper::encrypt($highlight->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the GalleryHighlights "created" event.
     */
    public function created(GalleryHighlights $highlight)
    {
        AuditLogs::create([
            "model" => "gallery_Highlights",
            "operation" => "C",
            "ref_id" => Helper::encrypt($highlight->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the GalleryHighlights "updated" event.
     */
    public function updated(GalleryHighlights $highlight)
    {
        // 
    }

    /**
     * Handle the GalleryHighlights "deleted" event.
     */
    public function deleted(GalleryHighlights $highlight)
    {
        //
    }

    /**
     * Handle the GalleryHighlights "restored" event.
     */
    public function restored(GalleryHighlights $highlight)
    {
        //
    }

    /**
     * Handle the GalleryHighlights "force deleted" event.
     */
    public function forceDeleted(GalleryHighlights $highlight)
    {
        //
    }
}
