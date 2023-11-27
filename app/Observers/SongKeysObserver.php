<?php

namespace App\Observers;

use App\Models\SongKeys;

class SongKeysObserver
{
    public function creating(SongKeys $song_key){
        $song_key->insert_by = session()->get("user_id");
        $song_key->update_by = session()->get("user_id");
        $song_key->insert_time = date("Y-m-d H:i:s");
        $song_key->update_time = date("Y-m-d H:i:s");
    }

    public function updating(SongKeys $song_key){
        $song_key->update_by = session()->get("user_id");
        $song_key->update_time = date("Y-m-d H:i:s");
    }
    /**
     * Handle the SongKeys "created" event.
     */
    public function created(SongKeys $song_key)
    {
        //
    }

    /**
     * Handle the SongKeys "updated" event.
     */
    public function updated(SongKeys $song_key)
    {
        //
    }

    /**
     * Handle the SongKeys "deleted" event.
     */
    public function deleted(SongKeys $song_key)
    {
        //
    }

    /**
     * Handle the SongKeys "restored" event.
     */
    public function restored(SongKeys $song_key)
    {
        //
    }

    /**
     * Handle the SongKeys "force deleted" event.
     */
    public function forceDeleted(SongKeys $song_key)
    {
        //
    }
}
