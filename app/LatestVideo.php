<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LatestVideo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $dates = ['deleted_at'];
    protected $table = 'latest_videos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['video_text', 'video_link','image', 'status', 'sort_order'];

    
}
