<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PCOTeamMembers;

class Users extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'password', 
        'first_name', 
        'last_name',
        'email',
        'contact',
        'dob',
        'occupation',
        'marital_status',
        'address',
        'country',
        'state',
        'city',
        'postcode',
        'religion',
        'is_attend_church',
        'church',
        'role_id',
        'is_admin',
        'is_first_login',
        'active',
        'insert_time',
        'update_time',
        'insert_by',
        'update_by',
        'www_access_token',
        'portal_access_token',
        'reset_token',
        'ip_address',
        'reset_time',
        'failed_attempt',
        'disabled_time',
    ];

    public function pco_roles(){
        return $this->hasMany(PCOTeamMembers::class, 'user_id', 'id')->where('active', 1);
    }

    public function pco_request(){
        return $this->hasMany(PCORequests::class, 'user_id', 'id')->where('active', 1);
    }

    public function unavailability(){
        return $this->hasMany(UserUnavailability::class, 'user_id', 'id')->where('active', 1);
    }

    public static function getFullnameById($user_id){
        $user = self::where('id', $user_id)->first();
        return $user->first_name . ' ' . $user->last_name;  
    }

    public function getFullname(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function role(){
        return $this->hasOne(PermissionRoles::class, 'id', 'role_id');
    }
}