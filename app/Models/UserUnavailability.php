<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class UserUnavailability extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'user_unavailability';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'reason',
        'active',
        'created_by',
        'updated_by'
    ];
}