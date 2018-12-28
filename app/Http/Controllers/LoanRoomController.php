<?php

namespace App\Http\Controllers;

use App\LoanRoom;
use App\LoanRoomRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LoanRoomController extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());
        Validator::make($request->all(), [
            'r_building_name' => 'required',
            'r_room_no' => 'required',
            'r_loanee_name' => 'required',
            'agent' => 'required',
            'r_mobile_number' => 'required|numeric',
            'r_start_date' => 'required|date_format:"d/m/Y"',
            'r_end_date' => 'required|date_format:"d/m/Y"',
            'r_loan_amount' => 'required|numeric',
            'r_grace_period' => 'required',
            'r_installment' => 'required',
        ])->validate();

        $loanUser = new LoanUserController();
        $loan = new LoanRoom();
        $loan->start_date = Carbon::createFromFormat('d/m/Y', Input::get('r_start_date'))->format('Y-m-d');
        $loan->end_date = Carbon::createFromFormat('d/m/Y', Input::get('r_end_date'))->format('Y-m-d');
        $loan->loan_amount = Input::get('r_loan_amount');
        $loan->installment = Input::get('r_installment');
        $loan->repay_amount = Input::get('r_loan_amount');
        $loan->paid_amount = 0;
        $loan->grace_period = Input::get('r_grace_period');
        $loan->percentage = Input::get('r_percentage');
        $loan->description = Input::get('r_description');
        $loan->paid = false;
        // Save the User and Agent of the Loan
        $loanUser = $loanUser->addLoanee($request, 'r_');
        $loan->user_id = $loanUser->id;
        $loan->agent_id = $loanUser->agent_id;
        try {
            $loan->save();
            $this->storeRoomLoan($loan);
        } catch (\Exception $e) {
            dd($e);
        }
        return redirect()->route('giveLoanView')->with(['success' => "Loan added Successfully"]);
    }

    function storeRoomLoan(LoanRoom $loan)
    {
        $records = collect();
        $start_date = Carbon::parse($loan->start_date);
        $end_date = Carbon::parse($loan->end_date);
        $amount = $loan->installment;
        while (!($start_date->diffInMonths($end_date) == 0)) {
            $records->push($this->recordCreator($loan, $start_date, $amount));
            $start_date->addMonth();
        }
        try {
            $chunks = $records->chunk(25);
            foreach ($chunks as $chunk) {
                DB::table('loan_percentage_records')->insert($chunk->toArray());
            }
        } catch (\Exception $e) {
            throw new \Exception('Error in creating Records' . $e);
        }
        return $loan;
    }

    function recordCreator($loan, Carbon $date, $amount)
    {
        $record = new LoanRoomRecord();
        $record->loan_id = $loan->id;
        $record->user_id = $loan->user_id;
        $record->record_date = $date->format('Y-m-d');
        $record->penalty_date = $date->copy()->addMonth();
        $record->record_amount = $amount;
        $record->remaining_amount = $amount;
        return $record;
    }
}
