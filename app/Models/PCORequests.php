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

    protected $table = 'pco_requests';
    public $timestamps = false;
    protected $fillable = [
        'pco_id',
        'user_id', 
        'custom',
        'value',
        'role_id', 
        'seq',
        'is_confirmed',
        'is_sent_email',
        'notes',
        'active',
        'created_by',
        'updated_by'
    ];

    public function pco(){
        return $this->hasOne(PCO::class, 'id', 'pco_id');
    }

    public function user(){
        return $this->hasOne(Users::class, 'id', 'user_id');
    }

    public function role(){
        return $this->hasOne(PCORoles::class, 'id', 'role_id');
    }
}