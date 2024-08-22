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
        $highlight->created_at = date('Y-m-d H:i:s');
        $highlight->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(GalleryHighlights $highlight){
        $highlight->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the GalleryHighlights 'created' event.
     */
    public function created(GalleryHighlights $highlight)
    {
    }

    /**
     * Handle the GalleryHighlights 'updated' event.
     */
    public function updated(GalleryHighlights $highlight)
    {
        // 
    }

    /**
     * Handle the GalleryHighlights 'deleted' event.
     */
    public function deleted(GalleryHighlights $highlight)
    {
        //
    }

    /**
     * Handle the GalleryHighlights 'restored' event.
     */
    public function restored(GalleryHighlights $highlight)
    {
        //
    }

    /**
     * Handle the GalleryHighlights 'force deleted' event.
     */
    public function forceDeleted(GalleryHighlights $highlight)
    {
        //
    }
}
