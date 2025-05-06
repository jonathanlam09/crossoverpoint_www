<?php
namespace App\Models;

use App\Models\Users;
use App\Models\EventAttachment;
use Illuminate\Database\Eloquent\Model;
 
class Events extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const PAYMENT_METHOD = [
        1 => 'Online transfer',
        2 => 'Cash',
        3 => 'Cheque',
        4 => 'E-wallet'
    ];

    protected $table = 'events';
    public $timestamps = false;
    protected $fillable = [
        'type',
        'name',
        'ch_name',
        'description', 
        'ch_description', 
        'start_date', 
        'end_date', 
        'registration_open_date',
        'registration_close_date',
        'room_description',
        'room_ch_description',
        'pic_id',
        'is_guest',
        'speaker_id',
        'speaker_name',
        'fee', 
        'payment_remarks',
        'payment_remarks_ch',
        'image', 
        'for_public',
        'active',
        'created_by',
        'updated_by'
    ];

    public function attachments(){
        return $this->hasMany(EventAttachments::class, 'event_id', 'id')->where('active', 1);
    }

    public function pic(){
        return $this->hasOne(Users::class, 'id', 'pic_id');
    }

    public function pco(){
        return $this->hasOne(PCO::class, 'ref_id', 'id')->where('type', 2);
    }

    public function pcos(){
        return $this->hasMany(PCO::class, 'ref_id', 'id')->where('type', 2);
    }

    public function pic_name(){
        $user = $this->pic;
        return $user ? $user->getFullname() : '-';
    }

    public function rooms(){
        return $this->hasMany(EventRooms::class, 'event_id', 'id')->where('active', 1);
    }

    public function room($id){
        return $this->hasMany(EventRooms::class, 'event_id', 'id')->where('id', );
    }

    public function registrants(){
        return $this->hasMany(EventRegistrations::class, 'event_id', 'id')->where('active', 1);
    }
}