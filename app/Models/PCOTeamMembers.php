<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class PCOTeamMembers extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'pco_team_members';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'pco_role_id', 
        'active',
        'created_by',
        'updated_by'
    ];

    public function user(){
        return $this->hasOne(Users::class, 'id', 'user_id')->where('active', 1);
    }

    public function role(){
        return $this->hasOne(PCORoles::class, 'id', 'pco_role_id');
    }

    public static function getGuitarists(){
        return self::getPCORoles(PCORoles::GUITARIST);
    }

    public static function getDrummers(){
        return self::getPCORoles(PCORoles::DRUMMER);
    }

    public static function getKeyboardists(){
        return self::getPCORoles(PCORoles::KEYBOARDIST);
    }

    public static function getBassists(){
        return self::getPCORoles(PCORoles::BASSIST);
    }

    public static function getSongLeaders(){
        return self::getPCORoles(PCORoles::SONG_LEADER);
    }

    public static function getCoSingers(){
        return self::getPCORoles(PCORoles::CO_SINGER);
    }

    public static function getSounds(){
        return self::getPCORoles(PCORoles::SOUND);
    }

    public static function getMedias(){
        return self::getPCORoles(PCORoles::MEDIA);
    }

    public static function getUshers(){
        return self::getPCORoles(PCORoles::USHER);
    }

    public static function getTranslators(){
        return self::getPCORoles(PCORoles::TRANSLATOR);
    }

    public static function getPreachers(){
        return self::getPCORoles(PCORoles::PREACHER);
    }

    public static function getPianists(){
        return self::getPCORoles(PCORoles::PIANIST);
    }

    public static function getPrayerLeaders(){
        return self::getPCORoles(PCORoles::PRAYER_LEADER);
    }

    public static function getBroadcasts(){
        return self::getPCORoles(PCORoles::BROADCAST);
    }

    public static function getVisualists(){
        return self::getPCORoles(PCORoles::VISUALIST);
    }

    public static function getPrayerTranslators(){
        return self::getPCORoles(PCORoles::PRAYER_TRANSLATOR);
    }

    public static function getPrayerKeyboardists(){
        return self::getPCORoles(PCORoles::PRAYER_KEYBOARDIST);
    }

    public static function getHolyCommunionLeaders(){
        return self::getPCORoles(PCORoles::HOLY_COMMUNION_LEADER);
    }

    public static function getAnnouncers(){
        return self::getPCORoles(PCORoles::ANNOUNCER);
    }

    public static function getAnnouncementTranslators(){
        return self::getPCORoles(PCORoles::ANNOUNCEMENT_TRANSLATOR);
    }

    public static function getPCORoles($pco_role_id){
        $roles = self::where([
            'active' => 1,
            'pco_role_id' => $pco_role_id
            ])
            ->get();

        if(count($roles) > 0){
            foreach($roles as $row){
                $row->user = $row->user;
                $row->user->unavailability = $row->user->unavailability;
            }
        }
        return $roles;
    }
}