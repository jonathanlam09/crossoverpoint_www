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

    const GUITARIST = 1;
    const DRUMMER = 2;
    const KEYBOARDIST = 3;
    const BASSIST = 4;
    const SONG_LEADER = 5;
    const CO_SINGER = 6;
    const SOUND = 7;
    const MEDIA = 8;
    const USHER = 9;
    const TRANSLATOR = 10;
    const PREACHER = 11;
    const PIANIST = 12;
    const PRAYER_LEADER = 13;
    const BROADCAST = 14;
    const VISUALIST = 17;
    const PRAYER_TRANSLATOR = 18;
    const PRAYER_KEYBOARDIST = 19;
    const HOLY_COMMUNION_LEADER = 21;
    const ANNOUNCER = 22;
    const ANNOUNCEMENT_TRANSLATOR = 23;
    
    protected $table = 'pco_roles';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'ch_title',
        'constant',
        'pco_team_id',
        'is_required_for_rehearsal',
        'active',
        'created_by',
        'updated_by'
    ];

    public function team(){
        return $this->hasOne(PCOTeams::class, 'id', 'pco_team_id');
    }
}