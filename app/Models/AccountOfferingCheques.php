<?php
 
namespace App\Models;

use App\Models\AccountOffering;
use Illuminate\Database\Eloquent\Model;

class AccountOfferingCheques extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account_offering_cheques';
    public $timestamps = false;
    protected $fillable = [
        'offering_id',
        'type',
        'cheque_number', 
        'cheque_amount',
        'active', 
        'created_by', 
        'updated_by'
    ];

    public function offering(){
        return $this->hasOne(AccountOfferings::class, 'id');
    }
}