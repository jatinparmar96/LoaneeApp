<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    public function records()
    {
        return $this->hasMany('App\LoanRecord','loan_id');
    }

    public function getUser()
    {
        return $this->belongsTo('App\LoanUser','user_id');
    }
    public function scopegetPending($query)
    {
        return $query->where('paid',0);
    }

    public function getAgent()
    {
        return $this->belongsTo('App\Agent','agent_id');
    }
}
