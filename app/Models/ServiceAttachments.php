<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class ServiceAttachments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'service_attachments';
    public $timestamps = false;
    protected $fillable = [
        'service_id',
        'name', 
        'path', 
        'extension',
        'active',
        'created_by',
        'updated_by'
    ];
}