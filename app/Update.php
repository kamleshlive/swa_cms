<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'updates';

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
    protected $fillable = ['left_text', 'right_text', 'image', 'link'];

    
}
