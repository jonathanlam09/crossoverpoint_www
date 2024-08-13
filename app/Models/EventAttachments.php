<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class EventAttachments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'event_attachments';
    public $timestamps = false;
    protected $fillable = [
        'event_id',
        'name',
        'path', 
        'extension',
        'active', 
        'insert_by',
        'update_by'
    ];
    
    public function event(){
        return $this->belongsTo(Event::class, 'id', 'event_id');
    }
}