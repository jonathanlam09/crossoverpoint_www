<?php

namespace App\Observers;

use App\Models\PCORequests;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class PCORequestsObserver
{
    public function creating(PCORequests $request){
        $request->created_by = session()->get('user_id');
        $request->updated_by = session()->get('user_id');
        $request->created_at = date('Y-m-d H:i:s');
        $request->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(PCORequests $request){
        $request->updated_by = session()->get('user_id');
        $request->updated_at = date('Y-m-d H:i:s');

        $prev_dt = [];
        $new_dt = [];
        $new_data = $request->getDirty();
        $old_data = $request->getOriginal();

        foreach($new_data as $key=>$row){
            if($key != 'updated_by' && $key != 'updated_at' && $key != 'active'){
                if($key == 'user_id'){
                    $old_user = Users::where([
                        'id' => $row,
                        'active' => 1
                    ])->first();
                    if(!$old_user){
                        throw new Exception('User not found!');
                    }
                    $new_user = Users::where([
                        'id' => $row,
                        'active' => 1
                    ])->first();
                    if(!$new_user){
                        throw new Exception('User not found!');
                    }
                    $prev_dt['user'] = $old_user->getFullname();
                    $new_dt['user'] =  $new_user->getFullname();
                }else{
                    $old = $old_data[$key];
                    $prev_dt[$key] = $old;
                    $new_dt[$key] =  $row;
                }
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
            'model' => 'pco_requests',
            'operation' => 'U',
            'ref_id' => Helper::encrypt($request->pco_id),
            'ip_address' => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the PCORequests 'created' event.
     */
    public function created(PCORequests $request)
    {
        AuditLogs::create([
            'model' => 'pco_requests',
            'operation' => 'C',
            'ref_id' => Helper::encrypt($request->pco_id),
            'ip_address' => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the PCORequests 'updated' event.
     */
    public function updated(PCORequests $request)
    {
        //
    }

    /**
     * Handle the PCORequests 'deleted' event.
     */
    public function deleted(PCORequests $request)
    {
        //
    }

    /**
     * Handle the PCORequests 'restored' event.
     */
    public function restored(PCORequests $request)
    {
        //
    }

    /**
     * Handle the PCORequests 'force deleted' event.
     */
    public function forceDeleted(PCORequests $request)
    {
        //
    }
}
