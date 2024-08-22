<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class PCOTeams extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'pco_teams';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'ch_name', 
        'leader_id', 
        'active',
        'created_by',
        'updated_by'
    ];

    public function leader(){
        return $this->hasOne(Users::class, 'id', 'leader_id');
    }
}