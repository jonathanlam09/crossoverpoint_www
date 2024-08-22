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

    protected $table = 'song_attachments';
    public $timestamps = false;
    protected $fillable = [
        'song_id',
        'song_key_id',
        'name',
        'path', 
        'extension',
        'active', 
        'created_by', 
        'updated_by'
    ];
}