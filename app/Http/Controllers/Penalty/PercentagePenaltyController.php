<?php

namespace App\Http\Controllers\Penalty;

use App\Http\Controllers\Controller;
use App\LoanPercentage;
use App\PenaltyPercentage;

class PercentagePenaltyController extends Controller
{
    public function create_new_penalty(LoanPercentage $loan)
    {
        $penalty = new PenaltyPercentage();
        $penalty->loan_id = $loan->id;
        $penalty->loan_id = $loan->id;
        $penalty->loan_id = $loan->id;
        $penalty->loan_id = $loan->id;
        $penalty->loan_id = $loan->id;
    }
}
