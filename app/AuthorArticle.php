<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorArticle extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'article';

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
    protected $fillable = ['art_main_heading', 'art_sub_heading', 'art_author_id', 'art_content', 'art_main_banner' , 'art_date', 'art_category_id', 'view', 'publish' , 'created_at' , 'updated_at' ];


}
