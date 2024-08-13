<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class PCOSongs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'pco_songs';
    public $timestamps = false;
    protected $fillable = [
        'pco_id',
        'song_id', 
        'song_key_id',
        'label',
        'active',
        'insert_by',
        'update_by'
    ];

    public function song(){
        return $this->hasOne(Songs::class, 'id', 'song_id')->where('active', 1);
    }

    public function key(){
        return Songs::keys[$this->song_key_id];
    }

    public function label(){
        return Songs::label[$this->label];
    }
}