<?php
namespace App\Models;

use App\Models\Users;
use Illuminate\Database\Eloquent\Model;
 
class EventRoomAttachments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'event_room_attachments';
    public $timestamps = false;
    protected $fillable = [
        'room_id',
        'path',
        'active',
        'created_by',
        'updated_by'
    ];

    public function room(){
        return $this->hasOne(EventRooms::class, 'id', 'room_id');
    }

    public function creator(){
        return $this->hasOne(Users::class, 'id', 'created_by');
    }
    
    public function modifier() {
        return $this->hasOne(Users::class, 'id', 'modified_by');
    }
}