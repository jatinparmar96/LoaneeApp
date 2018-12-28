<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
