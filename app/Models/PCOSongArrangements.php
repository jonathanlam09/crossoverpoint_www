<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class PCOSongArrangements extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'pco_song_arrangements';
    public $timestamps = false;
    protected $fillable = [
        'pco_id',
        'path', 
        'active',
        'insert_by',
    ];

    public function pco(){
        return $this->hasOne(PCO::class, 'id', 'pco_id')->where('active', 1);
    }

    public function user(){
        return $this->hasOne(Users::class, 'id', 'insert_by')->where('active', 1);
    }
}