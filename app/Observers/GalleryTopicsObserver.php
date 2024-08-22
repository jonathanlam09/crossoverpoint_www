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
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(GalleryTopics $topic){
        $topic->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the GalleryTopics 'created' event.
     */
    public function created(GalleryTopics $topic)
    {
    }

    /**
     * Handle the GalleryTopics 'updated' event.
     */
    public function updated(GalleryTopics $topic)
    {
        // 
    }

    /**
     * Handle the GalleryTopics 'deleted' event.
     */
    public function deleted(GalleryTopics $topic)
    {
        //
    }

    /**
     * Handle the GalleryTopics 'restored' event.
     */
    public function restored(GalleryTopics $topic)
    {
        //
    }

    /**
     * Handle the GalleryTopics 'force deleted' event.
     */
    public function forceDeleted(GalleryTopics $topic)
    {
        //
    }
}
