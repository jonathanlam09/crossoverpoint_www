<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class PCOSongs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "pco_songs";
    public $timestamps = false;
    protected $fillable = [
        "pco_id",
        "song_id", 
        "active",
        "insert_by",
        "update_by"
    ];
}