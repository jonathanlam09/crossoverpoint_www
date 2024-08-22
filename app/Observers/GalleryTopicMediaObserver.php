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
        $media->created_at = date('Y-m-d H:i:s');
        $media->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(GalleryTopicMedia $media){
        $media->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the GalleryTopicMedia 'created' event.
     */
    public function created(GalleryTopicMedia $media)
    {
    }

    /**
     * Handle the GalleryTopicMedia 'updated' event.
     */
    public function updated(GalleryTopicMedia $media)
    {
        // 
    }

    /**
     * Handle the GalleryTopicMedia 'deleted' event.
     */
    public function deleted(GalleryTopicMedia $media)
    {
        //
    }

    /**
     * Handle the GalleryTopicMedia 'restored' event.
     */
    public function restored(GalleryTopicMedia $media)
    {
        //
    }

    /**
     * Handle the GalleryTopicMedia 'force deleted' event.
     */
    public function forceDeleted(GalleryTopicMedia $media)
    {
        //
    }
}
