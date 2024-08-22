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

    protected $table = 'attendance';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'visitor_id',
        'type', 
        'ref_id', 
        'remarks', 
        'active', 
        'created_by', 
        'updated_by'
    ];

    public function user(){
        return $this->hasOne(Users::class, 'id', 'user_id');
    }
}