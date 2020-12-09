<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommiteeMember extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'commitee_member';

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
  protected $fillable = [ 'commitee_id', 'member_id'];


}
