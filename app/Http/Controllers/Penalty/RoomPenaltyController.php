<?php

namespace App\Http\Controllers\Penalty;

use App\Http\Controllers\Controller;
use App\LoanRoom;
use App\PenaltyRoom;
use Carbon\Carbon;

class RoomPenaltyController extends Controller
{
    public function create_new_penalty(LoanRoom $loan)
    {
        $penalty = new PenaltyRoom();
        $penalty->loan_id = $loan->id;
        $penalty->amount = 0;
        $penalty->received_amount = 0;
        $penalty->penalty_date = Carbon::parse($loan->start_date)->addMonth();
        $penalty->save();
    }

    public function check_penalty()
    {
        $today = Carbon::today();
        $query = PenaltyRoom::where('penalty_date', '<', $today)->where('paid', false)->get();
        foreach ($query as $data)
        {
            $start_time = Carbon::parse($data->penalty_date);
            while ($start_time->lessThan($today))
            {
                $count = $data->count;
                $penalty_amount = 0;
                while($count>=1){
                    $penalty_amount += $count * $data->loan_installment_amount;
                    $count--;
                }
                $data->amount = $penalty_amount;
                $data->count++;
                $data->penalty_date = Carbon::parse($data->penalty_date)->addMonth();
                $data->save();
                $start_time->addMonth();
            }
        }
    }
}
