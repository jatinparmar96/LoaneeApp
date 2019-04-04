<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Agent
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agent query()
 * @mixin \Eloquent
 */
class Agent extends Model
{
   public function getLoan()
   {
       return $this->hasMany('App\Loan','agent_id');
   }
    public function getUsers()
    {
        return $this->hasMany('App\LoanUser','agent_id');
    }
}
