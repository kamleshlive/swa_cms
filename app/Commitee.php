<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commitee extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'commitees';

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
    protected $fillable = ['name', 'parent_id', 'about', 'status', 'sort_order'];

    public function members()
    {
      return $this->belongsToMany('App\Member');
    }

    public function children()
    {
      return $this->hasMany('App\Commitee', 'parent_id', 'id');
    }
    public function parent()
    {
      return $this->belongsTo('App\Commitee', 'parent_id');
    }
}
