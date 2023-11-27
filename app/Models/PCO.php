<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PCO extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "pco";
    public $timestamps = false;
    protected $fillable = [
        "type",
        "ref_id",
        "date",
        "notes", 
        "active",
        "insert_by",
        "update_by"
    ];

    public function requests(){
        return $this->hasMany(PCORequests::class, "pco_id", "id")->where("active", 1);
    }

    public function sermon(){
        return $this->hasOne(Sermons::class, "id", "ref_id")->where("active", 1);
    }

    public function event(){
        return $this->hasOne(Events::class, "id", "ref_id")->where("active", 1);
    }

    public function songs(){
        return $this->hasMany(PCOSongs::class, "pco_id", "id")->where("active", 1);
    }

    public function attachments(){
        return $this->hasMany(PCOAttachments::class, "pco_id", "id")->where("active", 1);
    }

    public function getRequestedGuitarist(){
        return $this->getRequestedRole(1);
    }

    public function getRequestedDrummer(){
        return $this->getRequestedRole(2);
    }

    public function getRequestedKeyboardist(){
        return $this->getRequestedRole(3);
    }

    public function getRequestedBassist(){
        return $this->getRequestedRole(4);
    }

    public function getRequestedWorshipLeader(){
        return $this->getRequestedRole(5);
    }

    public function getRequestedBackupSingers(){
        return PCORequests::where([
            "pco_id" => $this->id,
            "role_id" => 6,
            "active" => 1,
        ])
        ->orderBy("id", "desc")
        ->get();
    }

    public function getRequestedSound(){
        return $this->getRequestedRole(7);
    }

    public function getRequestedMedia(){
        return $this->getRequestedRole(8);
    }

    public function getRequestedUshers(){
        return PCORequests::where([
            "pco_id" => $this->id,
            "role_id" => 9,
            "active" => 1,
        ])
        ->orderBy("id", "desc")
        ->get();
    }

    public function getRequestedTranslator(){
        return $this->getRequestedRole(10);
    }

    public function getRequestedPreacher(){
        if($this->type == 1){
            $ref = $this->sermon;
        }else{
            $ref = $this->event;
        }
        if($ref->is_guest == 0){
            if(isset($ref->speaker_id)){
                $preacher = Users::where("id", $ref->speaker_id)->first()->getFullname();
            }else{
                $preacher = isset($ref->speaker_name) ? $ref->speaker_name : "-";
            }
        }else{
            $preacher = isset($ref->speaker_name) ? $ref->speaker_name : "-";
        }
        return $preacher;
    }

    public function getRequestedPianist(){
        return $this->getRequestedRole(12);
    }

    public function getRequestedPrayerLeader(){
        return $this->getRequestedRole(13);
    }

    public function getRequestedBroadcast(){
        return $this->getRequestedRole(14);
    }


    public function getRequestedRole($role_id){
        return PCORequests::where([
            "pco_id" => $this->id,
            "role_id" => $role_id,
            "active" => 1,
        ])
        ->orderBy("id", "desc")
        ->first();
    }
}