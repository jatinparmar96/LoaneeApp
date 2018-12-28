<?php

namespace App\Http\Controllers;

use App\LoanPercentage;
use App\LoanPercentageRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LoanPercentageController extends Controller
{
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'p_card_number' => 'required',
            'p_loanee_name' => 'required',
            'p_mobile_number' => 'required|numeric',
            'p_start_date' => 'required|date_format:"d/m/Y"',
            'p_end_date' => 'required|date_format:"d/m/Y"',
            'p_loan_amount' => 'required|numeric',
            'p_percentage' => 'required|numeric',
            'p_grace_period' => 'required',
            'p_installment' => 'required',
        ])->validate();

        $loanUser = new LoanUserController();
        $loan = new LoanPercentage();
        $loan->start_date = Carbon::createFromFormat('d/m/Y', Input::get('p_start_date'))->format('Y-m-d');
        $loan->end_date = Carbon::createFromFormat('d/m/Y', Input::get('p_end_date'))->format('Y-m-d');
        $loan->loan_amount = Input::get('p_loan_amount');
        $loan->installment = Input::get('p_installment');
        $loan->repay_amount = Input::get('p_loan_amount');
        $loan->paid_amount = 0;
        $loan->grace_period = Input::get('p_grace_period');
        $loan->percentage = Input::get('p_percentage');
        $loan->description = Input::get('p_description');
        $loan->paid = false;
        // Save the User and Agent of the Loan
        $loanUser = $loanUser->addLoanee($request, 'p_');
        $loan->user_id = $loanUser->id;
        $loan->agent_id = $loanUser->agent_id;
        try {
            $loan->save();
            $this->storePercentageLoan($loan);
        } catch (\Exception $e) {
            dd($e);
        }

//        if ($loan->type === 'Days') {
//            $loanEndDate = $loanStartDate->copy()->addDays(Input::get('grace_period'));
//            $loan->lending_period = Input::get('lending_period');
//            $loan->grace_period = Input::get('grace_period');
//            $loan->end_date = $loanEndDate->format('Y-m-d');
//            $loan->installment = $loan->loan_amount / $loan->lending_period;
//            $loan->repay_amount = $loan->installment * $loan->grace_period;
//            $loan->save();
//            $loan = $this->storeDaysLoan($loan);
//
//        } else if($loan->type=='Percentage') {
//            if($loan->method !='Monthly'){
//                return redirect()->route('giveLoanView')->with(['error'=>"Only Monthly Payment supported for Room"]);
//            }
//            $loan->interest_percentage = Input::get('lending_period');
//            $loan->lending_period = Input::get('grace_period');
//            $this->storePercentageLoan($loan);
//        }
//        else{
//            if($loan->method !='Monthly'){
//                return redirect()->route('giveLoanView')->with(['error'=>"Only Monthly Payment supported for Percentage"]);
//            }
//            $loan->installment = Input::get('lending_period');
//            $years = Input::get('grace_period');
//            $loan->end_date = $loanStartDate->copy()->addYears($years);
//            $loan->repay_amount = $loan->installment * $years*12;
//            $loan->save();
//            $loan = $this->storeRoomLoan($loan);
//
//        }

        return redirect()->route('giveLoanView')->with(['success' => "Loan added Successfully"]);
    }

    function storePercentageLoan(LoanPercentage $loan)
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
        $record = new LoanPercentageRecord();
        $record->loan_id = $loan->id;
        $record->user_id = $loan->user_id;
        $record->record_date = $date->format('Y-m-d');
        $record->penalty_date = $date->copy()->addMonth();
        $record->record_amount = $amount;
        $record->remaining_amount = $amount;
        return $record;
    }

    public function list(Request $request)
    {
        $data = $this->query()->get();
        return json_encode($data);
    }

    function query()
    {
        $query = DB::table('loan_percentages as lp')
            ->leftJoin('loan_users as u', 'lp.user_id', 'u.id')
            ->leftJoin('agents as a', 'u.agent_id', 'a.id')
            ->select('lp.*')
            ->addSelect('u.*')
            ->addSelect('a.name as agent_name');
        return $query;
    }
}
