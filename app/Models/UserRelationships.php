<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class UserRelationships extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'user_relationships';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'related_user_id',
        'relationship',
        'active',
        'created_by',
        'updated_by'
    ];

    public function user() {
        return $this->hasOne(Users::class, 'id', 'user_id');
    }

    public function related_user() {
        return $this->hasOne(Users::class, 'id', 'related_user_id')->select(['id', 'first_name', 'last_name']);
    }
}