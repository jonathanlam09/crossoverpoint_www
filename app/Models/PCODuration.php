<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PCODuration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "pco_schedule_duration";
    public $timestamps = false;
    protected $fillable = [
        "name",
        "active",
        "insert_by",
        "update_by"
    ];
}