<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pentalty extends Model
{
    public function getRecord()
    {
        return $this->belongsTo('App\LoanRecord','record_id');
    }

    public function getLoan()
    {
        return $this->belongsTo('App\Loan','loan_id');
    }
    public function scopegetPending($query)
    {
        return $query->where('paid',0);
    }
}
