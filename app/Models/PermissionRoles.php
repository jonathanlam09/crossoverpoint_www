<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class PermissionRoles extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permission_roles';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'active', 
        'created_by', 
        'updated_by'
    ];

    public function permissions(){
        return $this->hasMany(Permissions::class, 'role_id', 'id')->where('active', 1);
    }
}
   