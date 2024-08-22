<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class AuditLogs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'audit_logs';
    public $timestamps = false;
    protected $fillable = [
        'prev_data', 
        'new_data', 
        'model', 
        'operation', 
        'ref_id', 
        'remarks', 
        'created_by', 
        'ip_address'
    ];

    public function user(){
        return $this->hasOne(Users::class, 'id', 'created_by');
    }
}