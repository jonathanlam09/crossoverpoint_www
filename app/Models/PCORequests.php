<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PCO;
use App\Models\Users;
 
class PCORequests extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "pco_requests";
    public $timestamps = false;
    protected $fillable = [
        "pco_id",
        "user_id", 
        "role_id", 
        "is_confirmed",
        "notes",
        "active",
        "insert_by",
        "update_by"
    ];

    public function pco(){
        return $this->belongsTo(PCO::class, "id", "pco_id");
    }

    public function user(){
        return $this->hasOne(Users::class, "id", "user_id");
    }

    public function role(){
        return $this->hasOne(PCORoles::class, "id", "role_id");
    }

    // public static function test(){
    //     $guitarist = DB::table("pco_request")
    //     ->where("pco_id", $row->id)
    //     ->where("role_id", 1)
    //     ->where("active", 1)
    //     ->orderBy("id", "desc")
    //     ->first();
    // }

    public static function getRequest($pco_role_id){
        $request = self::where([
            "pco_id" => $pco_role_id,
            "active" => 1
        ]);
    }
}