<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class GalleryTopicMedia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "gallery_topic_media";
    public $timestamps = false;
    protected $fillable = [
        "topic_id", 
        "type",
        "date",
        "filename",
        "path",
        "active",
        "insert_by",
        "update_by"
    ];
}