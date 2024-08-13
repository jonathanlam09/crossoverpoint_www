<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class Menus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const operation = [
        'create' => 1,
        'read' => 2,
        'update' => 3,
        'delete' => 4
    ];

    protected $table = 'menus';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'constant',
        'link',
        'seq',
        'ref_id',
        'active',
    ];

    public function get_submenu(){
        return self::where([
            'ref_id' => $this->id,
            'active' => 1
        ])->get();
    }
}