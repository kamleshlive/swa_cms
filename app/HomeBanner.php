<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class HomeBanner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    
    use SoftDeletes; //<--- use the softdelete traits
 
    protected $dates = ['deleted_at']; //<--- new field to be added in your table

    protected $table = 'home_banners';

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
    protected $fillable = ['title','link', 'image', 'status', 'sort_order'];

    
}
