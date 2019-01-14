<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Loan;
use App\LoanRecord;
use App\LoanUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PHPUnit\Util\Json;
use App\Pentalty;

class LoanUserController extends Controller
{
    public function addLoaneeView()
    {
        return view('Loan-Users.add-loanee');
    }

    public function addLoanee(Request $request,$q='')
    {
        $success = 'User added successfully';
        $agentId = 0;
        $loanUser = new LoanUser();
        $loanUser->card_number = Input::get($q.'card_number');
        $loanUser->name = Input::get($q.'loanee_name');
        $loanUser->mobile_no = Input::get($q.'mobile_number');
        $agentName = explode('-', Input::get('agent'));

        if (!(count($agentName) === 1)) {
            $agentId = $agentName[count($agentName) - 1];
        } elseif ($agentName[count($agentName) - 1] == "") {
            $agentId = 0;
        } 
        else 
        {
            $agent = new Agent();
            $agent->name = Input::get('agent');
            $agent->save();
            $agentId = $agent->id;
        }
        $loanUser->agent_id = $agentId;
        $loanUser->description = Input::get('desc');
        $loanUser->img = $this->storeImage($request->get($q.'imageSrc'));
        $loanUser->save();

        return $loanUser;
    }
    function storeImage($value)
    {
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));
        $imageName = time().str_random('4');
        file_put_contents('Images/'.$imageName.'.png',$data);
        return $imageName;
    }
    public function getAgent(Request $request)
    {
        $agents = Agent::all();
        return json_encode($agents);
    }

    public function viewLoanee(Request $request)
    {
        return view('Loan-Users.view-loanee');
    }

    public function getLoanee(Request $request)
    {
        $loanees = LoanUser::all();
        foreach ($loanees as $loanee)
        {
            $agent = $loanee->getAgent()->first()->name;
            $loanee->agent = $agent;
        }
        $loanees = json_encode($loanees);
        return $loanees;
    }

    public function viewLoaneeDetails($id)
    {
        $loanee = LoanUser::find($id);
        return view('Loan-Users.view-details', compact('loanee'));
    }

    public function editLoanee(Request $request, $id)
    {
        $success = "Entry edited successfully";
        $loanUser = LoanUser::where('id', $id)->first();

        $loanUser->card_number = Input::get('card-number');
        $loanUser->name = Input::get('loanee-name');
        $loanUser->mobile_no = Input::get('mobile-number');

        $loanUser->description = Input::get('desc');
        try {
            $loanUser->save();
            return redirect()->back()->with(['success' => $success]);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function viewAgent(Request $request)
    {
        $agents = Agent::all();
        return view('Loan-Users.view-agent',compact('agents'));
    }
    public function getAgentDetails(Request $request,$id)
    {
        $loans = Loan::where('agent_id',$id)->getPending()->get();
        foreach($loans as $loan)
        {
            $user = $loan->getUser()->first();
            $loan->card_number = $user->card_number;
            $loan->user_name = $user->name;
            $loan->mobile = $user->mobile_no;
            $amount = LoanRecord::where('loan_id',$loan->id)->where('record_date','<=',Carbon::today())->getPending()->pluck('remaining_amount')->sum();
            if($loan->type === 'Room')
            {
                $penalty_amount = Pentalty::where('loan_id',$loan->id)->getPending()->pluck('amount')->sum();
            }
            else
            {
                $penalty_amount = Pentalty::where('loan_id',$loan->id)->getPending()->orderBy('penalty_date','asc')->first();
                if ($penalty_amount !== null) 
                {
                    $penalty_amount = $penalty_amount->amount;
                }
                else
                {
                    $penalty_amount = 0;
                }
            }
            $loan->pending_amount = $amount; 
            $loan->penalty =  $penalty_amount;
        }
        return json_encode($loans);
    }

}
