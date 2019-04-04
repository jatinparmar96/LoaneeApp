<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pentalty
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pentalty getPending()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pentalty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pentalty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pentalty query()
 * @mixin \Eloquent
 */
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
