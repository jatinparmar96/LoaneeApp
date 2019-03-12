<?php

namespace App\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DailyReportController extends Controller
{
    public function get_view()
    {
        return view('Reports.daily-report');
    }
    public function daily_report(Request $request,$date='')
    {
        if ($date === '')
        {
            $date = Carbon::today();
        }
        else
        {
            $date = Carbon::createFromFormat('d-m-Y',$date)->startOfDay();

        }
        $data = $this->query()->whereDate('lr.updated_at',$date)->get();
        if(count($data) != 0)
        {
            $amount = 0;
            foreach($data as $record)
            {  
                $amount+=$record->amount;
            }
            $data->total_amount_today = $amount;
            return json_encode($data);
        }
      

    }
    function query()
    {
        $query = DB::table('loan_records as lr')
            ->leftJoin('loans as l','lr.loan_id','l.id')
            ->leftJoin('loan_users as u','l.user_id','u.id')
            ->leftJoin('agents as a','a.id','u.agent_id')
            ->select('a.name as agent')
            ->addSelect('l.id as loan_id')
            ->addSelect('u.name as user','u.card_number')
            ->addSelect(DB::raw('sum(lr.record_amount) as amount'))
            ->where('lr.paid',true)
            ->groupBy('l.id')
            ;
        return $query;
    }
}
