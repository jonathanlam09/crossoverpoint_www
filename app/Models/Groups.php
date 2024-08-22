<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class Groups extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'groups';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'active',
        'created_by',
        'updated_by'
    ];
}