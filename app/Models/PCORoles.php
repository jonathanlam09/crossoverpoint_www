<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class PCORoles extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "pco_roles";
    public $timestamps = false;
    protected $fillable = [
        "title",
        "active",
        "insert_by",
        "update_by"
    ];
}