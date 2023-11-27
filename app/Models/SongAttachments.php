<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class SongAttachments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "song_attachments";
    public $timestamps = false;
    protected $fillable = [
        "song_id",
        "name",
        "path", 
        "extension",
        "active", 
        "insert_by", 
        "update_by"
    ];
}