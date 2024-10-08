<?php

namespace App\Observers;

use App\Models\PCOAttachments;
use App\Models\Users;
use App\Models\AuditLogs;
use Helper;
use Exception;

class PCOAttachmentsObserver
{
    public function creating(PCOAttachments $attachment){
        $attachment->created_by = session()->get('user_id');
        $attachment->updated_by = session()->get('user_id');
        $attachment->created_at = date('Y-m-d H:i:s');
        $attachment->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(PCOAttachments $attachment){
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
            'model' => 'pco_attachments',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($attachment->id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCOAttachments 'created' event.
     */
    public function created(PCOAttachments $attachment)
    {
        AuditLogs::create([
            'model' => 'pco_attachments',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($attachment->id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCOAttachments 'updated' event.
     */
    public function updated(PCOAttachments $attachment)
    {
        //
    }

    /**
     * Handle the PCOAttachments 'deleted' event.
     */
    public function deleted(PCOAttachments $attachment)
    {
        //
    }

    /**
     * Handle the PCOAttachments 'restored' event.
     */
    public function restored(PCOAttachments $attachment)
    {
        //
    }

    /**
     * Handle the PCOAttachments 'force deleted' event.
     */
    public function forceDeleted(PCOAttachments $attachment)
    {
        //
    }
}
