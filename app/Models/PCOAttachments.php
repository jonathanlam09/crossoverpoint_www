<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PCOAttachments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'pco_attachments';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'pco_id',
        'path',
        'extension',
        'active',
        'created_by',
        'updated_by'
    ];

    public function pco(){
        return $this->hasOne(PCO::class, 'id', 'pco_id');
    }
}