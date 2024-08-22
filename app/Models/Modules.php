<?php
namespace App\Models;

use Helper;
use Illuminate\Database\Eloquent\Model;
 
class Modules extends Model
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

    protected $table = 'modules';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'constant',
        'link',
        'seq',
        'refId',
        'active',
    ];

    public function getSubModules(){
        $modules = self::where([
            'ref_id' => $this->id,
            'active' => 1
        ])->get();
        $modules = Helper::insert_encrypted_id(['body' => $modules]);
        return $modules;
    }
}