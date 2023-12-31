<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
 
class Attendance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "attendance";
    public $timestamps = false;
    protected $fillable = [
        "user_id",
        "type", 
        "ref_id", 
        "remarks", 
        "active", 
        "insert_by", 
        "update_by"
    ];

    public function user(){
        return $this->hasOne(Users::class, "id", "user_id");
    }
}