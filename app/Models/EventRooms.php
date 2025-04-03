<?php
namespace App\Models;

use App\Models\Users;
use App\Models\EventAttachment;
use Illuminate\Database\Eloquent\Model;
 
class EventRooms extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'event_rooms';
    public $timestamps = false;
    protected $fillable = [
        'event_id',
        'label',
        'ch_label',
        'price',
        'description', 
        'ch_description', 
        'active',
        'created_by',
        'updated_by'
    ];

    public function attachments(){
        return $this->hasMany(EventRoomAttachments::class, 'room_id', 'id')->where('active', 1);
    }
}