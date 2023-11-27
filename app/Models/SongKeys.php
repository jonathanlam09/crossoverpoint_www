<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class SongKeys extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "song_keys";
    public $timestamps = false;
    protected $fillable = [
        "name",
        "active", 
        "insert_by", 
        "update_by"
    ];
}