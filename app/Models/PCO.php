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
    protected $table = 'pco';
    public $timestamps = false;
    protected $fillable = [
        'type',
        'ref_id',
        'date',
        'rehearsal_datetime',
        'call_to_worship',
        'call_to_worship_ch',
        'notes', 
        'active',
        'created_by',
        'updated_by'
    ];

    public function requests(){
        return $this->hasMany(PCORequests::class, 'pco_id', 'id')->where('active', 1);
    }

    public function service(){
        return $this->hasOne(Services::class, 'id', 'ref_id');
    }

    public function event(){
        return $this->hasOne(Events::class, 'id', 'ref_id');
    }

    public function songs(){
        return $this->hasMany(PCOSongs::class, 'pco_id', 'id')
        ->where('active', 1);
    }

    public function attachments(){
        return $this->hasMany(PCOAttachments::class, 'pco_id', 'id')->where('active', 1);
    }

    public function getRequestedGuitarist(){
        return $this->getRequestedRole(PCORoles::GUITARIST);
    }

    public function getRequestedDrummer(){
        return $this->getRequestedRole(PCORoles::DRUMMER);
    }

    public function getRequestedKeyboardist(){
        return $this->getRequestedRole(PCORoles::KEYBOARDIST);
    }

    public function getRequestedBassist(){
        return $this->getRequestedRole(PCORoles::BASSIST);
    }

    public function getRequestedSongLeader(){
        return $this->getRequestedRole(PCORoles::SONG_LEADER);
    }

    public function getRequestedCoSingers(){
        return PCORequests::where([
            'pco_id' => $this->id,
            'role_id' => PCORoles::CO_SINGER,
            'active' => 1,
        ])
        ->first();
    }

    public function getRequestedCoSingerOne(){
        return PCORequests::where([
            'pco_id' => $this->id,
            'role_id' => PCORoles::CO_SINGER,
            'seq' => 1,
            'active' => 1,
        ])
        ->orderBy('id', 'desc')
        ->first();
    }
    public function getRequestedCoSingerTwo(){
        return PCORequests::where([
            'pco_id' => $this->id,
            'role_id' => PCORoles::CO_SINGER,
            'seq' => 2,
            'active' => 1,
        ])
        ->orderBy('id', 'desc')
        ->first();
    }

    public function getRequestedSound(){
        return $this->getRequestedRole(PCORoles::SOUND);
    }

    public function getRequestedMedia(){
        return $this->getRequestedRole(PCORoles::MEDIA);
    }

    public function getRequestedUshers(){
        return PCORequests::where([
            'pco_id' => $this->id,
            'role_id' => PCORoles::USHER,
            'active' => 1,
        ])
        ->orderBy('id', 'desc')
        ->get();
    }

    public function getRequestedUsherOne(){
        return PCORequests::where([
            'pco_id' => $this->id,
            'role_id' => PCORoles::USHER,
            'active' => 1,
            'seq' => 1
        ])
        ->orderBy('id', 'desc')
        ->first();
    }

    public function getRequestedUsherTwo(){
        return PCORequests::where([
            'pco_id' => $this->id,
            'role_id' => PCORoles::USHER,
            'active' => 1,
            'seq' => 2
        ])
        ->orderBy('id', 'desc')
        ->first();
    }


    public function getRequestedTranslator(){
        return $this->getRequestedRole(PCORoles::TRANSLATOR);
    }

    public function getRequestedPreacher(){
        if($this->type == 1){
            $ref = $this->service;
        }else{
            $ref = $this->event;
        }

        if(isset($ref)){
            if($ref->is_guest == 0){
                if(isset($ref->speaker_id)){
                    $preacher = Users::where('id', $ref->speaker_id)->first();
                    $preacher = $preacher ? $preacher->getFullname() : '-';
                }else{
                    $preacher = '-';
                }
            }else{
                $preacher = isset($ref->speaker_name) ? $ref->speaker_name : '-';
            }
        }else{
            $preacher = '-';
        }
        return $preacher;
    }

    public function getRequestedPianist(){
        return $this->getRequestedRole(PCORoles::PIANIST);
    }

    public function getRequestedPrayerLeader(){
        return $this->getRequestedRole(PCORoles::PRAYER_LEADER);
    }

    public function getRequestedBroadcast(){
        return $this->getRequestedRole(PCORoles::BROADCAST);
    }

    public function getRequestedPrayerTranslator(){
        return $this->getRequestedRole(PCORoles::PRAYER_TRANSLATOR);
    }

    public function getRequestedPrayerKeyboardist(){
        return $this->getRequestedRole(PCORoles::PRAYER_KEYBOARDIST);
    }

    public function getRequestedVisualist(){
        return $this->getRequestedRole(PCORoles::VISUALIST);
    }

    public function getRequestedAnnouncer(){
        return $this->getRequestedRole(PCORoles::ANNOUNCER);
    }

    public function getRequestedAnnouncementTranslator(){
        return $this->getRequestedRole(PCORoles::ANNOUNCEMENT_TRANSLATOR);
    }

    public function getRequestedHolyCommunionLeader($seq){
        $request = PCORequests::where([
            'pco_id' => $this->id,
            'role_id' => PCORoles::HOLY_COMMUNION_LEADER,
            'seq' => $seq,
            'active' => 1
        ])
        ->orderBy('id', 'desc')
        ->first();
        return $request;
    }

    public function getRequestedRole($role_id){
        $role = PCORoles::where([
            'id' => $role_id
        ])->first();
        if(!$role){
            return false;
        }

        if(isset($role->seq)){
            $request = PCORequests::where([
                'pco_id' => $this->id,
                'role_id' => $role_id,
                'active' => 1,
            ])
            ->orderBy('id', 'desc')
            ->get();
        }else{
            $request = PCORequests::where([
                'pco_id' => $this->id,
                'role_id' => $role_id,
                'active' => 1,
            ])
            ->orderBy('id', 'desc')
            ->first();
        }
        return $request;
    }
}