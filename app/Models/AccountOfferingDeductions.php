<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class AccountOfferingDeductions extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'account_offering_deductions';
    public $timestamps = false;
    protected $fillable = [
        'offering_id',
        'amount',
        'remark',
        'type',
        'active',
        'insert_by'
    ];

    public function offering(){
        return $this->hasOne(AccountOfferings::class, 'id', 'offering_id');
    }
}