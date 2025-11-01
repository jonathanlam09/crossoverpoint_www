<?php
namespace App\Models;

use App\Models\Users;
use App\Models\EventAttachment;
use Illuminate\Database\Eloquent\Model;
 
class EventRoomArrangements extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'event_room_arrangements';
    public $timestamps = false;
    protected $fillable = [
        'event_id',
        'room_id',
        'room_number',
        'members',
        'active',
        'created_by',
        'updated_by'
    ];
}