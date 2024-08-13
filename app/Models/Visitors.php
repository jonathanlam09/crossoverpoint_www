<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class Visitors extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const RELIGION = [
        1 => 'Christian',
        2 => 'Buddhist',
        3 => 'Hindhu',
        4 => 'Islam',
        5 => 'Atheist',
        6 => 'Agnostic'
    ];    
    protected $table = 'visitors';
    public $timestamps = false;
    protected $fillable = [
        'first_name', 
        'last_name',
        'email',
        'contact',
        'religion',
        'is_attend_church',
        'church_name',
        'active',
        'insert_time',
        'update_time',
        'insert_by',
        'update_by',
    ];

    public function getFullname(){
        return $this->first_name . ' ' . $this->last_name;
    }
}