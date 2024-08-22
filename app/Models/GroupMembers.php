<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class GroupMembers extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'group_members';
    public $timestamps = false;
    protected $fillable = [
        'group_id',
        'user_id',
        'active',
        'created_by',
        'updated_by'
    ];

    public function group(){
        return $this->hasOne(Groups::class, 'id', 'group_id');
    }

    public function user(){
        return $this->hasOne(Users::class, 'id', 'user_id');
    }
}