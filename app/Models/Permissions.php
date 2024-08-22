<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class Permissions extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'permissions';
    public $timestamps = false;
    protected $fillable = [
        'module_id',
        'role_id',
        'operation',
        'active',
        'created_by',
        'updated_by',
    ];

    public function menu(){
        return $this->hasOne(Modules::class, 'id', 'module_id');
    }

    public static function getPermissions(){
        $role_id = session()->get('role_id');
        return self::where([
            'role_id' => $role_id,
            'active' => 1
        ])->get();
    }
}