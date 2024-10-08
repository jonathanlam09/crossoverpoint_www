<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PCO;
 
class Services extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'services';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'ch_title',
        'description', 
        'ch_description', 
        'date', 
        'is_guest', 
        'broadcast_live',
        'speaker_id',
        'speaker_name', 
        'image', 
        'active',
        'created_by',
        'updated_by'
    ];

    public function pco(){
        return $this->hasOne(PCO::class, 'ref_id', 'id');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'ref_id', 'id')->where('active', 1);
    }
}