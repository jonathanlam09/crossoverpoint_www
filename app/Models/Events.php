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
        'pic_id',
        'is_guest',
        'speaker_id',
        'speaker_name',
        'fee', 
        'image', 
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

    public function pic_name(){
        $user = $this->pic;
        return $user ? $user->getFullname() : '-';
    }

    public function registrants(){
        return $this->hasMany(EventSignUps::class, 'event_id', 'id')->where('active', 1);
    }
}