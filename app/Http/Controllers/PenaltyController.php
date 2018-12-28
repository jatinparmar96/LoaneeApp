<?php

namespace App\Http\Controllers;

use App\Loan;
use App\LoanRecord;
use App\Pentalty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PenaltyController extends Controller
{
    private $tz = "Asia/Kolkata";
    private $daily = 'Daily';
    private $week = 'Weekly';
    private $month = 'Monthly';

    public function customPenalty(Request $request,$id)
    {
        
        $amount = $request->get('penalty_amount');
        $penalties = Pentalty::where('loan_id',$id)->getPending()->get();
        foreach ($penalties as $penalty)
        {
            $penalty->paid = true;
            $penalty->save();
        }
        $penalty = $penalties->last();
        $penalty->received_amount = $amount;
        $penalty->save();
        $record = LoanRecord::where('loan_id',$id)->getPending()->orderBy('record_date','asc')->first();
        
        $penalty = new Pentalty();
        $penalty->loan_id = $id;
        $penalty->amount = 0;
        $penalty->received_amount = 0;
        $penalty_date = Carbon::createFromFormat('Y-m-d',$record->record_date);
        if($record->method === 'Daily')
        {
            $penalty->penalty_date = $penalty_date->addDays(5);
        }
        else if($record->method === 'Weekly')
        {
            $penalty->penalty_date = $penalty_date->addWeek();
        }
        else 
        {
            $penalty->penalty_date = $penalty_date->addMonth();
        }
        $penalty->save();

        $setting = new DashboardController();
        
        $setting->updatePenaltySetting($amount);
        return redirect()->back();
    }
    public function refreshPenalty()
    {
        $this->newPenalty();

        return redirect()->back();
    }

    public function newPenalty()
    {
        set_time_limit(0);
        $loans = Loan::where('paid',false)->get();
        foreach($loans as $loan)
        {
            $today = Carbon::today();
            $penalty = Pentalty::where('loan_id',$loan->id)->get();
            if($loan->type === 'Room')
            {
                $penalty = Pentalty::where('loan_id',$loan->id)->get();
               
                $penalty_date = Carbon::createFromFormat('Y-m-d',$penalty->penalty_date);
            }
            else
            {
                $penalty = Pentalty::where('loan_id',$loan->id)->getPending()->first();
                if(!$penalty)
                {
                    $record = LoanRecord::where('loan_id',$loan->id)->orderBy('record_date','asc')->getPending()->first();
                    if(!$record)
                    {
                        continue;
                    }
                    $penalty = new Pentalty();
                    $penalty->loan_id = $loan->id;
                    $penalty->amount = 0;
                    $penalty->received_amount = 0;
                    $penalty_date = Carbon::createFromFormat('Y-m-d',$record->record_date);
                    if($loan->method === 'Daily')
                    {
                        $penalty->penalty_date = $penalty_date->addDays(5);
                    }
                    else if($loan->method === 'Weekly')
                    {
                        $penalty->penalty_date = $penalty_date->addWeek();
                    }
                    else 
                    {
                        $penalty->penalty_date = $penalty_date->addMonth();
                    }
                    $penalty->save();
                    $penalty = Pentalty::where('loan_id',$loan->id)->getPending()->first();
                }
                $penalty_date = Carbon::createFromFormat('Y-m-d',$penalty->penalty_date)->startOfDay();
            }
            if($today->greaterThanOrEqualTo($penalty_date))
            {
                $difference =  ($today->diffInDays($penalty_date));
                if($loan->method == 'Daily')
                {
                    $loop = (int) ($difference/4)+ 1;
                    $penalty->amount += $loan->installment * $loop;
                    $days = ($difference - $difference % 4) + 4;
                    $penalty->penalty_date = $penalty_date->copy()->addDays($days);
                }
                else if($loan->method == 'Weekly')
                {
                    $loop = (int) ($difference/7)+ 1;
                    $penalty->amount += $loan->installment * $loop;
                    $days = ($difference - $difference % 7) + 7;
                    $penalty->penalty_date = $penalty_date->copy()->addDays($days);
                }
                else
                {
                    $loop = (int) ($difference/30)+ 1;
                    $penalty->amount += $loan->installment * $loop;
                    $days = ($difference - $difference % 30) + 30;
                    $penalty->penalty_date = $penalty_date->copy()->addDays($days);
                }
                $penalty->save();
                
            }
        }
    }
    
    public function viewPenalty()
    {
        $this->newPenalty();
        return view('Loan.view-loans');
        

        $count = 0;
        $today = Carbon::today($this->tz)->format('Y-m-d');
        $loans = Loan::where('paid', false)->get();
        $counter = 0;
        $record_date = '';
        $penalties_array = [];
        foreach ($loans as $loan) {
            $record = LoanRecord::where('loan_id', $loan->id)
                                    ->where('paid', false)
                                    ->where('penalty_date', '<=', $today)
                                    ->orderBy('penalty_date','asc')
                                    ->first();
            if ($record !== null) {
                $penalties = Pentalty::where('record_id', $record->id)->get();
                if (count($penalties) == 0) 
                {
                    if ($record->method == $this->daily) 
                    {
                        $penalties_array[$count] = $this->createNewPenalty($loan->id,$record, 5);
                    } 
                    else if ($record->method == $this->week) 
                    {
                        $penalties_array[$count] = $this->createNewPenalty($loan->id,$record, 7);
                    } 
                    else 
                    {
                        $penalties_array[$count] = $this->createNewPenalty($loan->id,$record, 30);
                    }
                    $count++;
                }
                $this->updatePenalties($record,$loan->id);
            }
        }
      return view('Loan.view-loans');
    }

    public function getPenaltiesByLoan($id)
    {
        $penalties = Pentalty::where('loan_id',$id)->where('paid',false)->get();
        return json_encode($penalties);
    }

    function query()
    {
        $query = DB::table('loan_records as lr')
                    ->join('pentalties as p','p.record_id','lr.id')
                    ->select('p.loan_id','p.record_id','p.amount','p.penalty_date','p.next_penalty_date','p.paid','p.created_at','p.updated_at')
                    ->addSelect('lr.id');
                    return $query;
    }

    private function updatePenalties($record,$loan_id)
    {
        $paid_penalties = $this->query()
                        ->where('p.record_id',$record->id)
                        ->where('p.paid',true)
                        ->count();
        if ($paid_penalties == 0)
        {
            $query = Pentalty::where('record_id', $record->id)
                                ->getPending()
                                ->orderBy('next_penalty_date', 'desc');
        
           do
            {
                $latest_penalty = $query->first();
                $today = Carbon::today();
                $penalty_date = $this->createDate($latest_penalty->next_penalty_date);
                $penalty_creation_date = Carbon::createFromFormat('Y-m-d H:i:s', $latest_penalty->created_at)->format('Y-m-d');
                if ($today->greaterThanOrEqualTo($penalty_date))
                {
                    $penalty = new Pentalty();
                    $penalty->loan_id = $loan_id;
                    $penalty->record_id = $record->id;
                    $penalty->penalty_date = $penalty_date;
                    if ($record->method == 'Daily') {
                        $penalty->next_penalty_date = $penalty_date->copy()->addDays(5);
                        $penalty->amount = $record->record_amount;
                    } elseif ($record->method == 'Weekly') {
                        $penalty->next_penalty_date = $penalty_date->copy()->addDays(7);
                        $penalty->amount = $record->record_amount;
                    } elseif ($record->method == 'Monthly') {
                        $penalty->next_penalty_date = $penalty_date->copy()->addDays(30);
                        if ($record->type == 'Room') {
                            $penalty->amount = 500;
                        } else {
                            $penalty->amount = $record->record_amount;
                        }
                    }
                    $penalty->save();
                    $penalties = Pentalty::where('record_id', $record->id)->getPending()->orderBy('next_penalty_date', 'desc')->get();
                    $counter = 1;
                    foreach ($penalties as $penalty) {
                        $penalty->amount = $record->record_amount * $counter;
                        $counter++;
                    }
                    $collections = collect($penalties);
                    $chunks = $collections->chunk(50);
                    foreach($chunks as $chunk)
                    {
                        Pentalty::update($chunk->toArray());
                    }
                }
            } while($penalty_date->lessThan($today));

        }
    }

    public function payPenalty(Request $request, $id)
    {
        dd($request->all());
        $penalty = Pentalty::find($id);
        $penalty->paid = true;
        $penalty->amount = 0;
        $penalty->save();
        return  redirect()->back();
    }
    function createPenalties($loan_id,LoanRecord $record,$days)
    {
        //Get Current Date
        $today = Carbon::today($this->tz);


        //Get all the dates of the Current Record and see if eligible for penalty
        $record_date = $this->createDate($record->penalty_date);
        $start_date = $this->createDate($record->penalty_date);
        $next_penalty_date = $this->createDate($record->penalty_date);


        $penalty = new Pentalty();
        $penalty->loan_id = $loan_id;
        $penalty->record_id = $record->id;
        if($record->type =='Room')
        {
            $penalty->amount = 500;
        }
        else{
            $penalty->amount = $record->record_amount;
        }
        $penalty->penalty_date = $record->penalty_date;
        $penalty->next_penalty_date = $start_date->copy()->addDays($days);
        if($start_date< $today)
        {
            $penalty->save();
        }
    }


    private function createNewPenalty($loan_id,LoanRecord $record, $days)
    {
        $today = Carbon::today($this->tz);
        $penalties_array = [];
        $count = 0;

        $record_date = $this->createDate($record->penalty_date);
        $start_date = $this->createDate($record->penalty_date);
        $next_penalty_date = $this->createDate($record->penalty_date);

        $penalties = new Pentalty();
        $penalties->loan_id = $loan_id;
        $penalties->record_id = $record->id;
        if($record->type =='Room')
        {
            $penalties->amount = 500;
        }
        else
        {
            $penalties->amount = $record->record_amount;
        }
        $penalties->penalty_date = $record->penalty_date;
        $penalties->next_penalty_date = $start_date->copy()->addDays($days);
        $next_penalty_date = $penalties->next_penalty_date->copy();
       // $penalties->save();
        $record_date = $penalties->next_penalty_date;
        $penalties_array[$count] = $penalties;
        $count++;
        $start_date->addDays($days);

        if ($start_date < $today) {
            while ((!$start_date->diffInDays($today) == 0)) {
                if ($start_date->diffInDays($next_penalty_date)==0) {
                    $penalties = new Pentalty();
                    $penalties->loan_id = $loan_id;
                    $penalties->record_id = $record->id;
                     if($record->type =='Room')
                      {
                         $penalties->amount = 500;
                      }
                    else
                    {
                        $penalties->amount = $record->record_amount;
                    }
                    $penalties->penalty_date = $record_date;
                    $penalties->next_penalty_date = $start_date->copy()->addDays($days);
                    $next_penalty_date = $penalties->next_penalty_date->copy();
                  //  $penalties->save();
                    $record_date = $penalties->next_penalty_date;
                    $penalties_array[$count] = $penalties;
                    $count++;
                }
                $start_date->addDay();
            }
        }
        $counter =  count($penalties_array);
         foreach ($penalties_array as $penalty)
         {
             $penalty->amount = $penalty->amount *$counter;
             $counter= $counter-1;
             $penalty->save();
         }
//        foreach ($penalties_array as $penalty)
//        {
//            $penalty->amount = $penalty->amount * $counter;
//            $penalty->save();
//            break;
//        }
        return ($penalties_array);
    }

    private function createDate($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date);
    }


}
