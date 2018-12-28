<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
