<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PCO;
 
class Sermons extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "sermons";
    public $timestamps = false;
    protected $fillable = [
        "title",
        "description", 
        "date", 
        "is_guest", 
        "broadcast_live",
        "speaker_id",
        "speaker_name", 
        "image", 
        "active",
        "insert_by",
        "update_by"
    ];

    public function pco(){
        return $this->hasOne(PCO::class, "ref_id", "id");
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, "ref_id", "id")->where("active", 1);
    }

    public function speaker(){
        return $this->hasOne(Users::class, "id", "speaker_id");
    }
}