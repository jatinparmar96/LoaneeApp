<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LoanRecord
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanRecord getPending()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoanRecord query()
 * @mixin \Eloquent
 */
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
