<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class EventSignUps extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'event_sign_ups';
    public $timestamps = false;
    protected $fillable = [
        'event_id',
        'first_name',
        'last_name', 
        'email',
        'contact',
        'emergency_contact',
        'payment_method',
        'additional_remarks',
        'json_body',
        'active', 
        'created_by',
        'updated_by'
    ];
    
    public function event(){
        return $this->belongsTo(Events::class, 'id', 'event_id');
    }
}