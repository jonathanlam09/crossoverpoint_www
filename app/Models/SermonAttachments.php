<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class SermonAttachments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'sermon_attachments';
    public $timestamps = false;
    protected $fillable = [
        'sermon_id',
        'name', 
        'path', 
        'extension',
        'active',
        'insert_by',
        'update_by'
    ];
}