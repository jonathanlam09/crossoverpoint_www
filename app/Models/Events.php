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

    protected $table = "events";
    public $timestamps = false;
    protected $fillable = [
        "name",
        "description", 
        "start_date", 
        "end_date", 
        "registration_open_date",
        "registration_close_date",
        "pic_id",
        "is_guest",
        "speaker_id",
        "speaker_name",
        "fee", 
        "image", 
        "active",
        "insert_by",
        "update_by"
    ];

    public function attachments(){
        return $this->hasMany(EventAttachments::class, "event_id", "id")->where("active", 1);
    }

    public function pic(){
        return $this->hasOne(Users::class, "id", "pic_id")->where("active", 1);
    }

    public function pco(){
        return $this->hasOne(PCO::class, "ref_id", "id")->where("active", 1)->where("type", 2);
    }

    public function pic_name(){
        $user = $this->pic;
        return $user->getFullname();
    }

    public function registrants(){
        return $this->hasMany(EventSignUps::class, "event_id", "id")->where("active", 1);
    }
}