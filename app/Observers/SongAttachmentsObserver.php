<?php

namespace App\Observers;

use App\Models\SongAttachments;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class SongAttachmentsObserver
{
    public function creating(SongAttachments $attachment){
        $attachment->created_by = session()->get('user_id');
        $attachment->updated_by = session()->get('user_id');
        $attachment->created_at = date('Y-m-d H:i:s');
        $attachment->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(SongAttachments $attachment){
        $attachment->updated_by = session()->get('user_id');
        $attachment->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $attachment->getDirty();
        $old_data = $attachment->getOriginal();
        foreach($new_data as $key=>$row){
            if($key != 'updated_by' && $key != 'updated_at'){
                $old = $old_data[$key];
                $prev_dt[$key] = $old;
                $new_dt[$key] =  $row;
            }
        }
        $user = Users::where([
            'id' => session()->get('user_id'),
            'active' => 1
        ])->first();
        if(!$user){
            throw new Exception('User not found!');
        }

        $data = [
            'prev_data' => json_encode($prev_dt),
            'new_data' => json_encode($new_dt),
            'model' => 'song_attachments',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($attachment->path),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the SongAttachments 'created' event.
     */
    public function created(SongAttachments $attachment)
    {
        AuditLogs::create([
            'model' => 'song_attachments',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($attachment->path),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the SongAttachments 'updated' event.
     */
    public function updated(SongAttachments $attachment)
    {
        //
    }

    /**
     * Handle the SongAttachments 'deleted' event.
     */
    public function deleted(SongAttachments $attachment)
    {
        //
    }

    /**
     * Handle the SongAttachments 'restored' event.
     */
    public function restored(SongAttachments $attachment)
    {
        //
    }

    /**
     * Handle the SongAttachments 'force deleted' event.
     */
    public function forceDeleted(SongAttachments $attachment)
    {
        //
    }
}
