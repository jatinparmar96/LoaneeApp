<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LoanUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanUser query()
 * @mixin \Eloquent
 */
class LoanUser extends Model
{
  public function getLoan()
  {
      return $this->hasMany('App\Loans','user_id');
  }
    public function getAgent()
    {
        return $this->belongsTo('App\Agent','agent_id');
    }
}
