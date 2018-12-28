<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanRecord extends Model
{
    public function getloan()
    {
        return $this->belongsTo('App\Loan','loan_id');
    }
    public function getUser()
    {
        return $this->belongsTo('App\LoanUser','user_id');
    }

    public function scopegetPending($query)
    {
        return $query->where('paid',0);
    }
}
