<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class GalleryHighlights extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'gallery_highlights';
    public $timestamps = false;
    protected $fillable = [
        'type',
        'name', 
        'path',
        'active',
        'created_by',
        'updated_by'
    ];
}