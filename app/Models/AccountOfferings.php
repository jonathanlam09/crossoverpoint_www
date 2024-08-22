<?php
 
namespace App\Models;

use App\Models\AccountOfferingCheque;
use Illuminate\Database\Eloquent\Model;
 
class AccountOfferings extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'account_offerings';
    public $timestamps = false;
    protected $fillable = [
        'go_100', 'go_50', 'go_20', 'go_10', 'go_5', 'go_1', 'go_coin',
        'th_100', 'th_50', 'th_20', 'th_10', 'th_5', 'th_1', 'th_coin',
        'plg_100', 'plg_50', 'plg_20', 'plg_10', 'plg_5', 'plg_1', 'plg_coin',
        'mg_100', 'mg_50', 'mg_20', 'mg_10', 'mg_5', 'mg_1', 'mg_coin',
        'cm_100', 'cm_50', 'cm_20', 'cm_10', 'cm_5', 'cm_1', 'cm_coin',
        'other_reason', 'other_100', 'other_50', 'other_20', 'other_10', 'other_5', 'other_1', 'other_coin',
        'signature_1', 'witness_one', 'signature_2', 'witness_two', 
        'date', 'active', 'created_by', 'updated_by'
    ];

    public function creator(){
        return $this->hasOne(Users::class, 'id', 'created_by');
    }

    public function updater(){
        return $this->hasOne(Users::class, 'id', 'updated_by');
    }

    public function witness_one_user(){
        return $this->hasOne(Users::class, 'id', 'witness_one');
    }

    public function witness_two_user(){
        return $this->hasOne(Users::class, 'id', 'witness_two');
    }

    public function deductions(){
        return $this->hasMany(AccountOfferingDeductions::class, 'offering_id', 'id')->where('active', 1);
    }

    public function cheque(){
        return $this->hasMany(AccountOfferingCheques::class, 'offering_id', 'id')->where('active', 1);
    }

    public function getDeductionTotalAmount(){
        $total = 0;
        if(count($this->deductions) > 0){
            foreach($this->deductions as $row){
                $total += floatval($row->amount);
            }
        }
        return number_format($total, 2);
    }

    public function getTotalAmount(){
        $go_100 = $this->go_100 * 100;
        $go_50 = $this->go_50 * 50;
        $go_20 = $this->go_20 * 20;
        $go_10 = $this->go_10 * 10;
        $go_5 = $this->go_5 * 5;
        $go_1 = $this->go_1 * 1;
        $go_coin = floatval($this->go_coin);

        $th_100 = $this->th_100 * 100;
        $th_50 = $this->th_50 * 50;
        $th_20 = $this->th_20 * 20;
        $th_10 = $this->th_10 * 10;
        $th_5 = $this->th_5 * 5;
        $th_1 = $this->th_1 * 1;
        $th_coin = floatval($this->th_coin);

        $plg_100 = $this->plg_100 * 100;
        $plg_50 = $this->plg_50 * 50;
        $plg_20 = $this->plg_20 * 20;
        $plg_10 = $this->plg_10 * 10;
        $plg_5 = $this->plg_5 * 5;
        $plg_1 = $this->plg_1 * 1;
        $plg_coin = floatval($this->plg_coin);

        $mg_100 = $this->mg_100 * 100;
        $mg_50 = $this->mg_50 * 50;
        $mg_20 = $this->mg_20 * 20;
        $mg_10 = $this->mg_10 * 10;
        $mg_5 = $this->mg_5 * 5;
        $mg_1 = $this->mg_1 * 1;
        $mg_coin = floatval($this->mg_coin);

        $cm_100 = $this->cm_100 * 100;
        $cm_50 = $this->cm_50 * 50;
        $cm_20 = $this->cm_20 * 20;
        $cm_10 = $this->cm_10 * 10;
        $cm_5 = $this->cm_5 * 5;
        $cm_1 = $this->cm_1 * 1;
        $cm_coin = floatval($this->cm_coin);

        $other_100 = $this->other_100 * 100;
        $other_50 = $this->other_50 * 50;
        $other_20 = $this->other_20 * 20;
        $other_10 = $this->other_10 * 10;
        $other_5 = $this->other_5 * 5;
        $other_1 = $this->other_1 * 1;
        $other_coin = floatval($this->other_coin);
        $cheque = $this->cheque;

        $cheque_amount = 0;
        if($cheque->count() > 0){
            foreach($cheque as $row){
                $cheque_amount += $row->cheque_amount;
            }
        }

        $deductions = 0;
        if(count($this->deductions) > 0){
            foreach($this->deductions as $row){
                $deductions += $row->amount;
            }
        }

        $total = $go_100 + $go_50 + $go_20 + $go_10 + $go_5 + $go_1 + $go_coin +
        $th_100 + $th_50 + $th_20 + $th_10 + $th_5 + $th_1 + $th_coin + 
        $plg_100 + $plg_50 + $plg_20 + $plg_10 + $plg_5 + $plg_1 + $plg_coin + 
        $mg_100 + $mg_50 + $mg_20 + $mg_10 + $mg_5 + $mg_1 + $mg_coin + 
        $cm_100 + $cm_50 + $cm_20 + $cm_10 + $cm_5 + $cm_1 + $cm_coin + 
        $other_100 + $other_50 + $other_20 + $other_10 + $other_5 + $other_1 + $other_coin + 
        $cheque_amount - $deductions;
        return number_format($total, 2);
    }

    public function getSubTypeTotalAmount($type=null, $isSub = false){
        $go_100 = $this->go_100 * 100;
        $go_50 = $this->go_50 * 50;
        $go_20 = $this->go_20 * 20;
        $go_10 = $this->go_10 * 10;
        $go_5 = $this->go_5 * 5;
        $go_1 = $this->go_1 * 1;
        $go_coin = floatval($this->go_coin);

        $th_100 = $this->th_100 * 100;
        $th_50 = $this->th_50 * 50;
        $th_20 = $this->th_20 * 20;
        $th_10 = $this->th_10 * 10;
        $th_5 = $this->th_5 * 5;
        $th_1 = $this->th_1 * 1;
        $th_coin = floatval($this->th_coin);

        $plg_100 = $this->plg_100 * 100;
        $plg_50 = $this->plg_50 * 50;
        $plg_20 = $this->plg_20 * 20;
        $plg_10 = $this->plg_10 * 10;
        $plg_5 = $this->plg_5 * 5;
        $plg_1 = $this->plg_1 * 1;
        $plg_coin = floatval($this->plg_coin);

        $mg_100 = $this->mg_100 * 100;
        $mg_50 = $this->mg_50 * 50;
        $mg_20 = $this->mg_20 * 20;
        $mg_10 = $this->mg_10 * 10;
        $mg_5 = $this->mg_5 * 5;
        $mg_1 = $this->mg_1 * 1;
        $mg_coin = floatval($this->mg_coin);

        $cm_100 = $this->cm_100 * 100;
        $cm_50 = $this->cm_50 * 50;
        $cm_20 = $this->cm_20 * 20;
        $cm_10 = $this->cm_10 * 10;
        $cm_5 = $this->cm_5 * 5;
        $cm_1 = $this->cm_1 * 1;
        $cm_coin = floatval($this->cm_coin);

        $other_100 = $this->other_100 * 100;
        $other_50 = $this->other_50 * 50;
        $other_20 = $this->other_20 * 20;
        $other_10 = $this->other_10 * 10;
        $other_5 = $this->other_5 * 5;
        $other_1 = $this->other_1 * 1;
        $other_coin = floatval($this->other_coin);

        $cheque = $this->cheque;
        $cheque_amount = 0;
        if($cheque->count() > 0){
            foreach($cheque as $row){
                if($type != null){
                    if($row->type == $type && $row->active == 1){
                        $cheque_amount += $row->cheque_amount;
                    }
                }else{
                    $cheque_amount += $row->cheque_amount;
                }
            }
        }
       
        $total = 0;
        if($type == 'GO'){
            $total = $go_100 + $go_50 + $go_20 + $go_10 + $go_5 + $go_1 + $go_coin;
        }else if($type == 'PLG'){
            $total = $plg_100 + $plg_50 + $plg_20 + $plg_10 + $plg_5 + $plg_1 + $plg_coin;
        }else if($type == 'MG'){
            $total = $mg_100 + $mg_50 + $mg_20 + $mg_10 + $mg_5 + $mg_1 + $mg_coin;
        }else if($type == 'CM'){
            $total = $cm_100 + $cm_50 + $cm_20 + $cm_10 + $cm_5 + $cm_1 + $cm_coin;
        }else if($type == 'TH'){
            $total = $th_100 + $th_50 + $th_20 + $th_10 + $th_5 + $th_1 + $th_coin;
        }else if($type == 'OTHER'){
            $total = $other_100 + $other_50 + $other_20 + $other_10 + $other_5 + $other_1 + $other_coin;
        }else{
            $total = 0;
        }

        if(!$isSub){
            $total += $cheque_amount;
        }
        return number_format($total, 2);
    }
}