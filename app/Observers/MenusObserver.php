<?php

namespace App\Observers;

use App\Models\Menus;
use App\Models\AuditLogs;
use App\Models\Users;
use Helper;
use Exception;

class MenusObserver
{
    public function creating(Menus $menu){
        $menu->insert_by = session()->get("user_id");
        $menu->update_by = session()->get("user_id");
        $menu->insert_time = date("Y-m-d H:i:s");
        $menu->update_time = date("Y-m-d H:i:s");
    }

    public function updating(Menus $menu){
        $menu->update_by = session()->get("user_id");
        $menu->update_time = date("Y-m-d H:i:s");

        $prev_dt = [];
        $new_dt = [];
        $new_data = $menu->getDirty();
        $old_data = $menu->getOriginal();

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
            "model" => "menu",
            "operation" => "U",
            "ref_id" => Helper::encrypt($menu->id),
            "ip_address" => Helper::get_client_ip()
        ];
        AuditLogs::create($data);
    }
    /**
     * Handle the Menus "created" event.
     */
    public function created(Menus $menu)
    {
        AuditLogs::create([
            "model" => "menu",
            "operation" => "C",
            "ref_id" => Helper::encrypt($menu->id),
            "ip_address" => Helper::get_client_ip()
        ]);
    }

    /**
     * Handle the Menus "updated" event.
     */
    public function updated(Menus $menu)
    {
        //
    }

    /**
     * Handle the Menus "deleted" event.
     */
    public function deleted(Menus $menu)
    {
        //
    }

    /**
     * Handle the Menus "restored" event.
     */
    public function restored(Menus $menu)
    {
        //
    }

    /**
     * Handle the Menus "force deleted" event.
     */
    public function forceDeleted(Menus $menu)
    {
        //
    }
}