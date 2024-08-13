<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'songs';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'ch_name',
        'author', 
        'key_id', 
        'english_link', 
        'chinese_link',
        'lyrics_name',
        'ch_lyrics_name',
        'lyrics_path',
        'ch_lyrics_path',
        'active', 
        'insert_by', 
        'update_by'
    ];

    const label = [
        1 => 'Worship',
        2 => 'Response',
        3 => 'Prayer'
    ];

    const keys = [
        1 => 'A&#9837; Major',
        2 => 'A&#9837; Minor',
        3 => 'A Major',
        4 => 'A Minor',
        5 => 'A&#35; Major',
        6 => 'A&#35; Minor',
        7 => 'B&#9837; Major',
        8 => 'B&#9837; Minor',
        9 => 'B Major',
        10 => 'B Minor',
        11 => 'B&#35; Major',
        12 => 'B&#35; Minor',
        13 => 'C&#9837; Major',
        14 => 'C&#9837; Minor',
        15 => 'C Major',
        16 => 'C Minor',
        17 => 'C&#35; Major',
        18 => 'C&#35; Minor',
        19 => 'D&#9837; Major',
        20 => 'D&#9837; Minor',
        21 => 'D Major',
        22 => 'D Minor',
        23 => 'D&#35; Major',
        24 => 'D&#35; Minor',
        25 => 'E&#9837; Major',
        26 => 'E&#9837; Minor',
        27 => 'E Major',
        28 => 'E Minor',
        29 => 'E&#35; Major',
        30 => 'E&#35; Minor',
        31 => 'F&#9837; Major',
        32 => 'F&#9837; Minor',
        33 => 'F Major',
        34 => 'F Minor',
        35 => 'F&#35; Major',
        36 => 'F&#35; Minor',
        37 => 'G&#9837; Major',
        38 => 'G&#9837; Minor',
        39 => 'G Major',
        40 => 'G Minor',
        41 => 'G&#35; Major',
        42 => 'G&#35; Minor',
    ];

    public function attachments(){
        return $this->hasMany(SongAttachments::class, 'song_id', 'id')->where('active', 1);
    }

    public function attachments_with_key($key){
        return $this->hasMany(SongAttachments::class, 'song_id', 'id')->where('song_key_id', $key)->where('active', 1);
    }

    public function keys(){
        return $this->hasMany(SongAttachments::class, 'song_id', 'id')->where('active', 1)->whereNotNull('song_key_id');
    }
}