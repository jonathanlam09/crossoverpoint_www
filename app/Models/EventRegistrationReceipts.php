<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class EventRegistrationReceipts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'event_registration_receipts';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'ref_id',
        'path', 
        'remarks',
        'active',
        'created_by',
    ];
    
    public function registration() {
        return $this->belongsTo(EventRegistrations::class, 'refId', 'id');
    }
}