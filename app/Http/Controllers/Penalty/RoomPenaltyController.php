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
        $penalty->loan_installment_amount = $loan->installment;
        $penalty->received_amount = 0;
        $penalty->penalty_date = Carbon::parse($loan->start_date)->addMonth();
        $penalty->save();
    }

    public function check_penalty()
    {
        $today = Carbon::today();
        $query = PenaltyRoom::where('penalty_date', '<', $today)->where('paid', false)->get();

    }
}
