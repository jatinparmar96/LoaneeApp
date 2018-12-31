<?php

namespace App\Http\Controllers\Penalty;

use App\Http\Controllers\Controller;
use App\LoanPercentage;
use App\PenaltyPercentage;
use Carbon\Carbon;

class PercentagePenaltyController extends Controller
{
    public function create_new_penalty(LoanPercentage $loan)
    {
        $penalty = new PenaltyPercentage();
        $penalty->loan_id = $loan->id;
        $penalty->amount = 0;
        $penalty->loan_installment_amount = $loan->installment;
        $penalty->received_amount = 0;
        $penalty->penalty_date = Carbon::parse($loan->start_date)->addMonth();
        $penalty->save();
    }

    public function check_penalty()
    {
        $today = Carbon::today();
        $query = PenaltyPercentage::where('penalty_date', '<', $today)->where('paid',false)->get();
        foreach ($query as $data) {
            $stop = Carbon::parse($data->penalty_date);
            while($stop->lessThanOrEqualTo($today)){
                $data->amount = $data->amount + $data->loan_installment_amount;
                $data->penalty_date = Carbon::parse($data->penalty_date)->addMonth();
                $stop->addMonth();
                $data->active_status = true;
                $data->save();
            }
        }
    }


}
