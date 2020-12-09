<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sc_membership_varification extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_membership_varifications';

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
    protected $fillable = ['about', 'image_icon', 'name', 'designation', 'popup_image', 'popup_description', 'sort'];

    
}
