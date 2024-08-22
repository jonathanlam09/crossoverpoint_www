<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class GalleryTopics extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'gallery_topics';
    public $timestamps = false;
    protected $fillable = [
        'name', 
        'path',
        'active',
        'created_by',
        'updated_by'
    ];

    public function media(){
        return $this->hasMany(GalleryTopicMedia::class, 'topic_id', 'id')
        ->where('active', 1)
        ->orderBy('date', 'DESC');
    }
}