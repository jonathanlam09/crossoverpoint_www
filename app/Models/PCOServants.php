<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\PCORole;

class PCOServants extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "pco_servants";
    public $timestamps = false;
    protected $fillable = [
        "user_id",
        "pco_role_id", 
        "active",
        "insert_by",
        "update_by"
    ];

    public function user(){
        return $this->hasOne(Users::class, "id", "user_id")->where("active", 1);
    }

    public function role(){
        return $this->hasOne(PCORoles::class, "id", "pco_role_id");
    }

    public static function getGuitarists(){
        return self::getPCORoles(1);
    }

    public static function getDrummers(){
        return self::getPCORoles(2);
    }

    public static function getKeyboardists(){
        return self::getPCORoles(3);
    }

    public static function getBassists(){
        return self::getPCORoles(4);
    }

    public static function getWorshipLeaders(){
        return self::getPCORoles(5);
    }

    public static function getBackupSingers(){
        return self::getPCORoles(6);
    }

    public static function getSounds(){
        return self::getPCORoles(7);
    }

    public static function getMedias(){
        return self::getPCORoles(8);
    }

    public static function getUshers(){
        return self::getPCORoles(9);
    }

    public static function getTranslators(){
        return self::getPCORoles(10);
    }

    public static function getPreachers(){
        return self::getPCORoles(11);
    }

    public static function getPianists(){
        return self::getPCORoles(12);
    }

    public static function getPrayerLeaders(){
        return self::getPCORoles(13);
    }

    public static function getBroadcasts(){
        return self::getPCORoles(14);
    }

    public static function getPCORoles($pco_role_id){
        $roles = self::where([
            "active" => 1,
            "pco_role_id" => $pco_role_id
            ])
            ->get();

        if(count($roles) > 0){
            foreach($roles as $row){
                $row->name = $row->user ? $row->user->getFullname() : "-";
            }
        }
        return $roles;
    }
}