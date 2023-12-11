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
        1 => "Christian",
        2 => "Buddhist",
        3 => "Hindhu",
        4 => "Islam",
        5 => "Atheist",
        6 => "Agnostic"
    ];    
    const SEX = [
        1 => "Male",
        2 => "Female"
    ];
    const purpose = [
        1 => "I want to receive Christ",
        2 => "I need healing",
        3 => "I want to know more about Christ",
        4 => "I need spiritual counselling"
    ];
    const MARITAL_STATUS = [
        1 => "Married",
        2 => "Single",
        3 => "Divorced",
        4 => "Widowed"
    ];
    protected $table = "visitors";
    public $timestamps = false;
    protected $fillable = [
        "first_name", 
        "last_name",
        "email",
        "contact",
        "religion",
        "sex",
        "address",
        "occupation",
        "marital_status",
        "is_attend_church",
        "church_name",
        "purpose",
        "active",
        "insert_time",
        "update_time",
        "insert_by",
        "update_by",
    ];

    public function getFullname(){
        return $this->first_name . " " . $this->last_name;
    }
}