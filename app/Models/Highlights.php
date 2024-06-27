<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class Highlights extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "highlights";
    public $timestamps = false;
    protected $fillable = [
        "type",
        "ref_id",
        "name",
        "path",
        "active",
        "insert_by",
        "update_by"
    ];
}