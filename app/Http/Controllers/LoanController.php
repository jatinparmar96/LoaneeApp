<?php

namespace App\Http\Controllers;

use App\Loan;
use App\LoanRecord;
use App\LoanUser;
use App\Pentalty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    private $user_id = 0;

    public function giveLoan(Request $request)
    {
        return view('Loan.give-loan');
    }

    public function viewLoan(Request $request)
    {
        return view('Loan.view-loans');
    }

    public function viewLoanDetails($id)
    {

        return view('Loan.view-loan-details', compact('id'));
    }

    public function getRecords($id)
    {
        $loan = Loan::find($id);
        $records = json_encode($loan->Records()->get());
        return $records;
    }

    public function getLoans($id, $type = '')
    {
        $array_loans = [];
        $count = 0;

        if ($id == 0) {
            $loans = Loan::where('type', $type)->getPending()->get();
        } else {
            $loans = Loan::where('user_id', $id)->get();
            return json_encode($loans);
        }
        foreach ($loans as $loan) {
            $user = $loan->getUser()->first();
            $array_loans [$count] = $loan->toArray();
            $amount = LoanRecord::where('loan_id', $loan->id)->getPending()->pluck('record_amount')->sum();
            if ($loan->type === 'Room') {
                $penalty_amount = Pentalty::where('loan_id', $loan->id)->getPending()->pluck('amount')->sum();
            } else {
                $penalty_amount = Pentalty::where('loan_id', $loan->id)->getPending()->orderBy('penalty_date', 'asc')->first();
                if ($penalty_amount !== null) {
                    $penalty_amount = $penalty_amount->amount;
                } else {
                    $penalty_amount = 0;
                }
            }
            $array_loans[$count]['remaining_amount'] = $amount + $penalty_amount;
            $array_loans[$count]['user_name'] = $user->name;
            $array_loans[$count]['card_number'] = $user->card_number;
            $count++;
        }
        return json_encode($array_loans);
    }

    //Loan Details
    public function LoanDetails(Request $request, $id)
    {
        $latest_paid_date = 'No Last Payment';
        $end_date = 'No Payment Remaining';
        $penalty_amount = 0;
        $total_amount = 0;
        $loan = Loan::where('id', $id)->first();
        $user = $loan->getUser()->first();
        $agent = $user->getAgent()->first();
        $records = LoanRecord::where('loan_id', $id)->getPending();
        $current_pending_amount = $records->where('record_date', '<=', Carbon::today())->pluck('remaining_amount')->sum();
        $records_amount = LoanRecord::where('loan_id', $id)->getPending()->pluck('remaining_amount')->sum();
        $records_latest_pending = $records->first();
        $loan_start_date = $loan->start_date;
        $loan_end_date = $loan->end_date;
        $pending_amount = $records_amount;

        $latest_paid_record = LoanRecord::where([
            ['paid', 1],
            ['loan_id', $id]
        ])->orderBy('record_date', 'desc')->first();

        if ($latest_paid_record) {
            $latest_paid_date = Carbon::createFromFormat('Y-m-d', $latest_paid_record->record_date)->format('d/m/Y');
        }
        if ($records_latest_pending) {
            $end_date = Carbon::createFromFormat('Y-m-d', $records_latest_pending->record_date)->format('d/m/Y');
        }

        if ($loan->type === 'Room') {
            $penalty_amount = Pentalty::where('loan_id', $loan->id)->getPending()->pluck('amount')->sum();
        } else {
            $penalty_amount = Pentalty::where('loan_id', $loan->id)->getPending()->orderBy('penalty_date', 'asc')->first();
            if ($penalty_amount !== null) {
                $penalty_amount = $penalty_amount->amount;
            } else {
                $penalty_amount = 0;
            }
        }
        $total_amount = $penalty_amount + $pending_amount;
        return view('Loan.loan-details-profile',
            compact(
                'loan',
                'user',
                'agent',
                'current_pending_amount',
                'pending_amount',
                'records_latest_pending',
                'latest_paid_date',
                'total_amount',
                'penalty_amount',
                'end_date',
                'loan_start_date',
                'loan_end_date'
            ));
    }


    //Store Loan Method
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'card_number' => 'required',
            'loanee_name' => 'required',
            'mobile_number' => 'required|numeric',
            'agent' => 'required',
            'startDate' => 'required|date_format:"d/m/Y"',
            'endDate' => 'required|date_format:"d/m/Y"',
            'loanAmount' => 'required|numeric',
            'lending_period' => 'required',
            'grace_period' => 'required',
            'installment' => 'required',
        ])->validate();
        $loanUser = new LoanUserController();
        $loan = new Loan();
        $loanStartDate = Carbon::createFromFormat('d/m/Y', Input::get('endDate'));

        $loan->type = 'Days';
        $loan->method = Input::get('Method');
        $loan->start_date = Carbon::createFromFormat('d/m/Y', Input::get('startDate'))->format('Y-m-d');
        $loan->end_date = Carbon::createFromFormat('d/m/Y', Input::get('endDate'))->format('Y-m-d');
        $loan->repay_amount = Input::get('loanAmount');
        $loan->installment = Input::get('installment');
        $loan->description = Input::get('description');
        $loan->lending_period = Input::get('lending_period');
        $loan->grace_period = Input::get('grace_period');
        $loan->loan_amount = $loan->installment * Input::get('lending_period');
        $loanUser = $loanUser->addLoanee($request);
        $loan->user_id = $loanUser->id;
        $loan->agent_id = $loanUser->agent_id;
        $loan->save();
        $loan = $this->storeDaysLoan($loan);
        return redirect()->route('giveLoanView')->with(['success' => "Loan added Successfully"]);
    }

    function storeDaysLoan(Loan $loan)
    {
        $count = 0;
        $amount = $loan->installment;
        $start_date = Carbon::createFromFormat('d/m/Y', Input::get('startDate'));
        $end_date = Carbon::createFromFormat('d/m/Y', Input::get('endDate'));;

        $record = [];
        //Daily Calculation
        if ($loan->method === 'Daily') {
            $loan->loan_amount = $loan->installment * Input::get('lending_period');
            $loan->save();
            while (!($end_date->diffInDays($start_date) == 0)) {
                $record[$count] = $this->recordCreator($loan, $start_date, $amount);
                $start_date->addDay();
                $count++;
            }
        } //Weekly Calculation
        elseif ($loan->method === 'Weekly') {
            $loan->loan_amount = $loan->installment * (Input::get('lending_period') / 7);
            $loan->save();
            while (!($end_date->diffInWeeks($start_date) === 0)) {
                $recurring_amount = $amount;
                $record[$count] = $this->recordCreator($loan, $start_date, $recurring_amount);
                $start_date->addWeek();
                if ($end_date->diffInDays($start_date) < 7) {
                    $anomaly = $end_date->diffInDays($start_date);
                    $recurring_amount = ($amount / 7) * $anomaly;
                    $start_date->addDays($anomaly);
                    $count++;
                    $record[$count] = $this->recordCreator($loan, $start_date, $recurring_amount);
                    break;
                }
                $count++;
            }
        } //Monthly Calculation
        else {
            $loan->loan_amount = $loan->installment * (Input::get('lending_period') / 30);
            $loan->save();
            $total_amount = $loan->repay_amount;
            while (!($end_date->diffInMonths($start_date)) == 0) {
                $recurring_amount = $amount;
                $record[$count] = $this->recordCreator($loan, $start_date, $recurring_amount);
                $total_amount = $total_amount - $amount;
                $start_date->addMonth();
                if ($end_date->diffInDays($start_date) < 30) {

                    $anomaly = $end_date->diffInDays($start_date);
                    $recurring_amount = $total_amount;
                    $start_date->addDays($anomaly);
                    $count++;
                    $record[$count] = $this->recordCreator($loan, $start_date, $recurring_amount);
                    break;
                }
                $count++;
            }
        }
        $record = LoanRecord::where('loan_id', $loan->id)->orderBy('record_date', 'asc')->first();
        $record->paid = true;
        $record->save();
        $record = LoanRecord::where('loan_id', $loan->id)->orderBy('record_date', 'asc')->getPending()->first();
        $penalty = new Pentalty();
        $penalty->loan_id = $loan->id;
        $penalty->amount = 0;
        $penalty->received_amount = 0;
        $penalty_date = Carbon::createFromFormat('Y-m-d', $record->record_date);
        if ($loan->method === 'Daily') {
            $penalty->penalty_date = $penalty_date->addDays(5);
        } else if ($loan->method === 'Weekly') {
            $penalty->penalty_date = $penalty_date->addWeek();
        } else {
            $penalty->penalty_date = $penalty_date->addMonth();
        }
        $penalty->save();
        return $loan;
    }

    function recordCreator($loan, $date, $amount)
    {
        $record = new LoanRecord();
        $record->loan_id = $loan->id;
        $record->user_id = $loan->user_id;
        $record->record_date = $date->format('Y-m-d');
        if ($loan->method === 'Daily') {
            $record->penalty_date = $date->copy()->addDays(5)->format('Y-m-d');
        } else if ($loan->method === 'Weekly') {
            $record->penalty_date = $date->copy()->addWeek()->format('Y-m-d');
        } else {
            $record->penalty_date = $date->copy()->addMonth()->format('Y-m-d');
        }
        $record->record_amount = $amount;
        $record->remaining_amount = $amount;
        $record->type = $loan->type;
        $record->method = $loan->method;
        $record->save();
        return $record;
    }

    public function closeCard(Request $request, $id)
    {
        $loan = Loan::where('id', $id)->first();
        LoanUser::where('id', $loan->user_id)->delete();
        LoanRecord::where('loan_id', $id)->delete();
        Pentalty::where('loan_id', $id)->delete();
        $loan->delete();
        return redirect()->route('viewLoans');
    }

    function storeRoomLoan(Loan $loan)
    {
        $count = 0;
        $repayAmount = $loan->repay_amount;
        $start_date = Carbon::createFromFormat('m/d/Y', Input::get('endDate'));
        $records = [];
        $month = $loan->lending_period;
        $years = Input::get('grace_period');
        $end_date = $start_date->copy()->addYears($years);
        $amount = $loan->installment;
        while (!($start_date->diffInMonths($end_date) == 0)) {
            $records[$count] = $this->recordCreator($loan, $start_date, $amount);
            $count++;
            $start_date->addMonth();
        }
        return $loan;
    }

    public function extendRecords(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $extend_date = Carbon::createFromFormat('d/m/Y', $request->get('extend_date'))->startOfDay();
        $records = LoanRecord::where('loan_id', $id)->getPending()->orderBy('record_date', 'asc')->get();

        foreach ($records as $record) {
            $record->record_date = $extend_date;
            $record->save();
            if ($loan->method === 'Daily') {
                $extend_date->addDay();
            } else if ($loan->method === 'Weekly') {
                $extend_date->addWeek();
            } else {
                $extend_date->addMonth();
            }
        }
        $record = LoanRecord::where('loan_id', $id)->getPending()->orderBy('record_date', 'asc')->first();
        if ($record) {
            $controller = new RecordController();
            $controller->updatePenalty($id, $record);
        }
        return redirect()->back();
    }

    public function list(Request $request)
    {
        $data = $this->get_records()->get();
        return json_encode($data);
    }

    function get_records()
    {
        $query = DB::table('loan_records as lr')
            ->leftJoin('loans as l', 'l.id', '=', 'lr.loan_id')
            ->leftJoin('pentalties as p', 'l.id', 'p.loan_id')
            ->leftJoin('loan_users as u', 'u.id', 'l.user_id')
            ->select('l.*')
            ->addSelect(DB::raw("SUM(lr.record_amount) as pending_amount"))
            ->addSelect('p.amount as penalty_amount')
            ->addSelect('u.name', 'u.card_number')
            ->where('lr.record_date', '<=', Carbon::today())
            ->where('lr.paid', false)
            ->where('p.paid', false)
            ->groupBy('lr.loan_id');
        return $query;
    }

    function query()
    {
        $query = DB::table('loans as l')
            ->leftJoin('loan_users as u', 'l.user_id', 'u.id')
            ->leftJoin('agents as a', 'u.agent_id', 'a.id')
            ->select('l.*')
            ->addSelect('u.name', 'u.card_number');
        return $query;
    }
}
