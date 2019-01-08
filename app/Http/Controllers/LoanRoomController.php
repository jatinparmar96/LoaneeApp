<?php

namespace App\Http\Controllers;

use App\Agent;
use App\LoanRoom;
use App\LoanRoomRecord;
use App\PenaltyRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LoanRoomController extends Controller
{
    public function store(Request $request)
    {
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

        $loan->building_name = Input::get('r_building_name');
        $loan->room_no = Input::get('r_room_no');
        $loan->name = Input::get('r_loanee_name');
        $loan->mobile_no = Input::get('r_mobile_number');
        $loan->agent_id = $this->handle_agent(Input::get('agent'));
        $loan->start_date = Carbon::createFromFormat('d/m/Y', Input::get('r_start_date'))->format('Y-m-d');
        $loan->end_date = Carbon::createFromFormat('d/m/Y', Input::get('r_end_date'))->format('Y-m-d');
        $loan->loan_amount = Input::get('r_loan_amount');
        $loan->installment = Input::get('r_installment');
        $loan->repay_amount = Input::get('r_loan_amount');
        $loan->grace_period = Input::get('r_grace_period');
        $loan->description = Input::get('r_description');

        $loan->paid_amount = 0;
        $loan->paid = false;
        // Save the User and Agent of the Loan

        $loan->save();
        $this->storeRoomLoan($loan);

        return redirect()->route('giveLoanView')->with(['success' => "Loan added Successfully"]);
    }

    function handle_agent($agent)
    {
        $agent_id = 0;
        $agentName = explode('-', $agent);
        if (!(count($agentName) === 1)) {
            $agent_id = $agentName[count($agentName) - 1];
        } elseif ($agentName[count($agentName) - 1] == "") {
            $agent_id = 0;
        } else {
            $agent = new Agent();
            $agent->name = Input::get('agent');
            $agent->save();
            $agent_id = $agent->id;
        }
        return $agent_id;
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
        $chunks = $records->chunk(25);
        foreach ($chunks as $chunk) {
            DB::table('loan_room_records')->insert($chunk->toArray());

        }
        app('App\Http\Controllers\Penalty\RoomPenaltyController')->create_new_penalty($loan);
        return $loan;
    }

    function recordCreator($loan, Carbon $date, $amount)
    {
        $record = new LoanRoomRecord();
        $record->loan_id = $loan->id;
        $record->record_date = $date->format('Y-m-d');
        $record->penalty_date = $date->copy()->addMonth()->day(15);
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
        $query = DB::table('loan_rooms as lr')
            ->leftJoin('agents as a', 'lr.agent_id', 'a.id')
            ->select('lr.*')
            ->addSelect('a.name as agent_name');
        return $query;
    }

    function show(Request $request, $id)
    {
        $data = $this->query()->where('lr.id', $id)->first();
        $total_today = LoanRoomRecord::where('loan_id', $id)
            ->where('paid', false)
            ->where('record_date', '<=', Carbon::today())
            ->pluck('record_amount')->sum();
        $total = LoanRoomRecord::where('loan_id', $id)
            ->where('paid', false)
            ->pluck('record_amount')->sum();
        $next_payment_date = LoanRoomRecord::where('loan_id', $id)
            ->where('paid', false)
            ->orderBy('record_date', 'asc')
            ->first();
        $last_paid_date = LoanRoomRecord::where('loan_id', $id)
            ->where('paid', true)
            ->orderBy('record_date', 'desc')
            ->first();
        if ($last_paid_date) {
            $data->last_paid_date = Carbon::createFromFormat('Y-m-d', $last_paid_date->latest)
                ->format('d/m/Y');
        } else {
            $data->last_paid_date = "No Last Payment";
        }

        if ($next_payment_date) {
            $data->next_payment_date = Carbon::createFromFormat('Y-m-d', $next_payment_date->record_date)
                ->format('d/m/Y');
        } else {
            $data->next_payment_date = "No Payments Remaining";
        }

        $data->pending_amount = $total_today;
        $data->total_pending_amount = $total;
        $data->penalty = PenaltyRoom::where('loan_id', $id)
            ->where('paid', false)
            ->pluck('amount')->sum();
        $data->total_amount_remaining = $data->pending_amount + $data->penalty;
        $data->start_date = Carbon::createFromFormat('Y-m-d', $data->start_date)->format('d/m/Y');
        $data->end_date = Carbon::createFromFormat('Y-m-d', $data->end_date)->format('d/m/Y');
//        dd($data);
        return view('Loan-Profile.loan-profile-room', compact('data'));

    }

    function get_records()
    {
        $query = DB::table('loan_percentage_records as lrp')
            ->leftJoin('loan_percentages as lp', 'lrp.loan_id', 'lr.id')
            ->select('lrp.id as record_id');
        return $query;
    }

    function close_card(Request $request, $id)
    {
        PenaltyRoom::where('loan_id', $id)->delete();
        LoanRoomRecord::where('loan_id', $id)->delete();
        LoanRoom::where('id', $id)->delete();
        return redirect()->route('viewLoans');

    }
}
