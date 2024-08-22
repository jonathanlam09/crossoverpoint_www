<?php

namespace App\Observers;

use App\Models\ServiceAttachments;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class ServiceAttachmentsObserver
{
    public function creating(ServiceAttachments $attachment){
        $attachment->created_by = session()->get('user_id');
        $attachment->updated_by = session()->get('user_id');
        $attachment->created_at = date('Y-m-d H:i:s');
        $attachment->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(ServiceAttachments $attachment){
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
            'model' => 'service_attachments',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($attachment->path),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the ServiceAttachments 'created' event.
     */
    public function created(ServiceAttachments $attachment)
    {
        AuditLogs::create([
            'model' => 'service_attachments',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($attachment->path),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the ServiceAttachments 'updated' event.
     */
    public function updated(ServiceAttachments $attachment)
    {
        //
    }

    /**
     * Handle the ServiceAttachments 'deleted' event.
     */
    public function deleted(ServiceAttachments $attachment)
    {
        //
    }

    /**
     * Handle the ServiceAttachments 'restored' event.
     */
    public function restored(ServiceAttachments $attachment)
    {
        //
    }

    /**
     * Handle the ServiceAttachments 'force deleted' event.
     */
    public function forceDeleted(ServiceAttachments $attachment)
    {
        //
    }
}
