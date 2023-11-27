<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SongAttachment;

class Songs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "songs";
    public $timestamps = false;
    protected $fillable = [
        "name",
        "author", 
        "key_id", 
        "english_link", 
        "chinese_link",
        "active", 
        "insert_by", 
        "update_by"
    ];

    const keys = [
        1 => "A&#9837;",
        2 => "A",
        3 => "A&#35;",
        4 => "B&#9837;",
        5 => "B",
        6 => "B&#35;",
        7 => "C&#9837;",
        8 => "C",
        9 => "C&#35;",
        10 => "D&#9837;",
        11 => "D",
        12 => "D&#35;",
        13 => "E&#9837;",
        14 => "E",
        15 => "E&#35;",
        16 => "F&#9837;",
        17 => "F",
        18 => "F&#35;",
        19 => "G&#9837;",
        20 => "G",
        21 => "G&#35;",
    ];

    public function attachments(){
        return $this->hasMany(SongAttachments::class, "song_id", "id")->where("active", 1);
    }

    public function key(){
        return $this->hasOne(SongKeys::class, "id", "key_id");
    }
}