<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $dates = ['deleted_at'];
    protected $table = 'home_articles';

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
    protected $fillable = ['art_main_heading', 'art_sub_heading', 'art_author_id', 'art_contect', 'art_date', 'art_category_id', 'view', 'publish'];


}
