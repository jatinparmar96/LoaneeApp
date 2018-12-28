<?php

namespace App\Http\Controllers;

use App\Agent;
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
}
