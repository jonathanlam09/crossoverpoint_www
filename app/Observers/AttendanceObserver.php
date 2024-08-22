<?php
namespace App\Observers;

use App\Models\Attendance;

class AttendanceObserver
{
    public function creating(Attendance $attendance){
        $attendance->created_by = session()->get('user_id');
        $attendance->updated_by = session()->get('user_id');
        $attendance->created_at = date('Y-m-d H:i:s');
        $attendance->updated_at = date('Y-m-d H:i:s');
    }

    public function updating(Attendance $attendance){
        $attendance->updated_by = session()->get('user_id');
        $attendance->updated_at = date('Y-m-d H:i:s');
    }
    /**
     * Handle the Attendance 'created' event.
     */
    public function created(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the Attendance 'updated' event.
     */
    public function updated(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the Attendance 'deleted' event.
     */
    public function deleted(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the Attendance 'restored' event.
     */
    public function restored(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the Attendance 'force deleted' event.
     */
    public function forceDeleted(Attendance $attendance)
    {
        //
    }
}
